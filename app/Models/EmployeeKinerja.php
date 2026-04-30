<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        $potonganPph21   = $this->pph21;

        return $potonganBpjstk + $potonganAbsensi + $potonganPph21;
    }

    /**
     * Hitung gaji bersih yang diterima.
     */
    public function hitungGajiDiterima(): int
    {
        $totalPendatapan = $this->hitungTotalPendapatan();
        // dd($totalPendatapan);

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
                'pph21' => $this->pph21,
            ]
        ];
    }
}
