<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class EmployeeKinerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'periode',
        'total_hadir',
        'tunjangan_groom',
        'srp',
        'grosir',
        'aksesoris',
        'bonus',
        'bpjstk',
        'absensi',
        'pph21',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Hitung total pendapatan kotor berdasarkan setting gaji aktif.
     */

    public function hitungTotalPendapatan(): int
    {
        $setting = SettingGaji::query()->first();
        if (!$setting) return 0;

        $gajiPokok = $this->total_hadir * $setting->rate_gaji_pokok;
        $tunjanganKerapihan = $this->tunjangan_groom * $setting->rate_tunjangan_groom;
        $valueSrp = $this->srp * $setting->rate_srp;
        $valueGrosir = $this->grosir * $setting->rate_grosir;
        $valueAksesoris = $this->aksesoris * $setting->rate_aksesoris;

        return $gajiPokok + $tunjanganKerapihan + $valueSrp + $valueGrosir + $valueAksesoris + $this->bonus;
    }

    // untuk hitung total pph21
    public function hitungTotalPph21(): int
    {
        $setting = SettingGaji::query()->first();
        if (!$setting) return 0;
        $totalPendapatan = $this->hitungTotalPendapatan();

        $hasilAkhir = $totalPendapatan;
        $statusPtkp = Auth::user()->employee?->ptkpStatus;
        $rate = TerRate::query()->where('category_id', $statusPtkp?->category_id)
            ->where('min_salary', '<=', $hasilAkhir)
            ->where(function ($q) use ($hasilAkhir) {
                $q->where('max_salary', '>=', $hasilAkhir)
                    ->orWhereNull('max_salary');
            })
            ->first();

        $pph21 = $hasilAkhir * ($rate?->rate / 100);

        return $pph21;
    }

    // untuk list di table
    public function hitungListPph21($employeeId): int
    {
        $setting = SettingGaji::query()->first();
        if (!$setting) {
            return 0;
        }

        $employee = Employee::with('ptkpStatus')->find($employeeId);
        if (!$employee || !$employee->ptkpStatus) {
            return 0;
        }


        $hasilAkhir = $this->hitungTotalPendapatan();
        $rate = TerRate::query()
            ->where('category_id', $employee->ptkpStatus->category_id)
            ->where('min_salary', '<=', $hasilAkhir)
            ->where(function ($q) use ($hasilAkhir) {
                $q->where('max_salary', '>=', $hasilAkhir)
                    ->orWhereNull('max_salary');
            })
            ->first();

        if (!$rate) {
            return 0;
        }



        return $hasilAkhir * ($rate->rate / 100);
    }

    /**
     * Hitung total potongan.
     * Diasumsikan absensi dan bpjstk yang diinput adalah nominal / jumlah yang akan dikalikan dengan setting?
     * User: "BPJSTK = 50.000", "absensi = 10.000".
     * Mari asumsikan $this->bpjstk dan $this->absensi adalah jumlah pengali, atau jika user mengisi nominal langsung di kinerja:
     * Jika field 'bpjstk' di database berisi 1, maka potongannya 1 * 50.000.
     * Jika field 'bpjstk' di database sudah nominal (50.000), maka tidak perlu dikali setting.
     * Mengacu ke "Gaji Pokok = 30.000 x total hadir (25)", mungkin potongan_absensi = 10.000 x absensi (hari).
     * PPh21 diinput nominal langsung.
     */
    public function hitungTotalPotongan(): int
    {
        $setting = SettingGaji::query()->first();
        if (!$setting) return 0;

        $potonganBpjstk = 0;

        if ($this->employee && $this->employee->join_date) {
            $joinDate = Carbon::parse($this->employee->join_date);
            $today = Carbon::now();

            // jika sudah lebih dari / sama dengan 3 bulan
            if ($joinDate->diffInMonths($today) >= 3) {
                $potonganBpjstk = $setting->potongan_bpjstk;
            }
        }

        $potonganAbsensi = $this->absensi * $setting->potongan_absensi;
        $potonganPph21   = $this->hitungTotalPph21();

        return $potonganBpjstk + $potonganAbsensi + $potonganPph21;
    }

    /**
     * Hitung gaji bersih yang diterima.
     */
    public function hitungGajiDiterimaList(): int
    {
        $employeeId = $this->employee->id;

        $gaji = $this->hitungTotalPendapatan()
            - $this->hitungListPph21($employeeId);

        return $gaji - $this->hitungTotalPotongan();
    }

    public function hitungGajiDiterima(): int
    {
        return $this->hitungTotalPendapatan() - $this->hitungTotalPotongan();
    }

    // Rincian untuk ditampilkan di slip:
    public function rincianGaji(): array
    {
        $setting = SettingGaji::query()->first();
        if (!$setting) return [];

        $potonganBpjstk = 0;

        if ($this->employee && $this->employee->join_date) {
            $joinDate = Carbon::parse($this->employee->join_date);

            if ($joinDate->diffInMonths(now()) >= 3) {
                $potonganBpjstk = $setting->potongan_bpjstk;
            }
        }

        return [
            'pendapatan' => [
                'gaji_pokok' => $this->total_hadir * $setting->rate_gaji_pokok,
                'tunjangan_kerapihan' => $this->tunjangan_groom * $setting->rate_tunjangan_groom,
                'srp' => $this->srp * $setting->rate_srp,
                'grosir' => $this->grosir * $setting->rate_grosir,
                'aksesoris' => $this->aksesoris * $setting->rate_aksesoris,
                'bonus' => $this->bonus,
            ],
            'potongan' => [
                'bpjstk' => $potonganBpjstk,
                'absensi' => $this->absensi * $setting->potongan_absensi,
                'pph21' => $this->hitungTotalPph21(),
            ]
        ];
    }
}
