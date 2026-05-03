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
        'status_gaji',
        'transferred_by',
        'status_diterima'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function transferredBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'transferred_by');
    }

    /**
     * Hitung total pendapatan kotor berdasarkan setting gaji aktif.
     */

    public function hitungTotalPendapatan(): int
    {
        $setting = SettingGaji::first();
        if (!$setting) return 0;

        $employee = Employee::with('jabatan')->find($this->employee_id);

        if (!$employee || !$employee->jabatan) {
            return 0;
        }

        $rateGajiPokok = $employee->jabatan->rate_gaji_pokok;
        $isSales = stripos($employee->jabatan->nama, 'sales') !== false;

        $gajiPokok          = $this->total_hadir * $rateGajiPokok;
        $tunjanganKerapihan = $this->tunjangan_groom * $setting->rate_tunjangan_groom;
        $valueSrp           = $isSales ? $this->srp * $setting->rate_srp : 0;
        $valueGrosir        = $isSales ? $this->grosir * $setting->rate_grosir : 0;
        $valueAksesoris     = $isSales ? $this->aksesoris * $setting->rate_aksesoris : 0;

        return $gajiPokok
            + $tunjanganKerapihan
            + $valueSrp
            + $valueGrosir
            + $valueAksesoris
            + $this->bonus;
    }

    // untuk hitung total pph21
    public function hitungTotalPph21(): int
    {
        $setting = SettingGaji::query()->first();
        if (!$setting) return 0;

        // Gunakan employee pemilik kinerja, bukan Auth::user()
        $employee = $this->employee ?? Employee::with('ptkpStatus')->find($this->employee_id);
        if (!$employee) return 0;

        $totalPendapatan = $this->hitungTotalPendapatan();
        $hasilAkhir      = $totalPendapatan;

        $rate = TerRate::query()
            ->where('category_id', $employee->ptkpStatus?->category_id)
            ->where('min_salary', '<=', $hasilAkhir)
            ->where(function ($q) use ($hasilAkhir) {
                $q->where('max_salary', '>=', $hasilAkhir)
                    ->orWhereNull('max_salary');
            })
            ->first();

        return (int) ($hasilAkhir * ($rate?->rate / 100));
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

        $potonganAbsensi = $this->absensi * $setting->potongan_absensi;
        $potonganPph21   = $this->hitungTotalPph21();


        return $this->hitungPotonganBpjstk($setting) + $potonganAbsensi + $potonganPph21;
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
    private function hitungPotonganBpjstk(SettingGaji $setting): int
    {
        if (!$this->employee || !$this->employee->join_date) {
            return 0;
        }

        $masaKerja = Carbon::parse($this->employee->join_date)->diffInMonths(now());
        $bebasSampai = $setting->bebas_bpjstk_bulan ?? 3;

        // Kena BPJS jika masa kerja sudah >= batas bebas
        return $masaKerja >= $bebasSampai ? $setting->potongan_bpjstk : 0;
    }

    // public function hitungTotalPotongan(): int
    // {
    //     $setting = SettingGaji::query()->first();
    //     if (!$setting) return 0;

    //     return $this->hitungPotonganBpjstk($setting)
    //         + ($this->absensi * $setting->potongan_absensi)
    //         + $this->hitungTotalPph21();
    // }

    public function rincianGaji(): array
    {
        $setting = SettingGaji::query()->first();
        if (!$setting) return [];

        $employee = $this->employee ?? Employee::with('jabatan')->find($this->employee_id);

        if (!$employee || !$employee->jabatan) {
            return [];
        }

        $rateGajiPokok = $employee->jabatan->rate_gaji_pokok ?? 0;
        $isSales       = stripos($employee->jabatan->nama, 'sales') !== false;

        return [
            'pendapatan' => [
                'gaji_pokok'          => $this->total_hadir * $rateGajiPokok,
                'tunjangan_kerapihan' => $this->tunjangan_groom * $setting->rate_tunjangan_groom,
                'srp'                 => $isSales ? $this->srp * $setting->rate_srp : 0,
                'grosir'              => $isSales ? $this->grosir * $setting->rate_grosir : 0,
                'aksesoris'           => $isSales ? $this->aksesoris * $setting->rate_aksesoris : 0,
                'bonus'               => $this->bonus,
            ],
            'potongan' => [
                'bpjstk'  => $this->hitungPotonganBpjstk($setting),
                'absensi' => $this->absensi * $setting->potongan_absensi,
                'pph21'   => $this->hitungListPph21($this->employee_id),
            ]
        ];
    }
    public function rincianGajiList($employeeId): array
    {
        $setting = SettingGaji::first();
        if (!$setting) return [];

        $employee = Employee::with('jabatan')
            ->where('id', $employeeId)
            ->first();

        if (!$employee || !$employee->jabatan) {
            return [];
        }

        $rateGajiPokok = $employee->jabatan->rate_gaji_pokok ?? 0;
        $isSales       = stripos($employee->jabatan->nama, 'sales') !== false;

        return [
            'pendapatan' => [
                'gaji_pokok'          => $this->total_hadir * $rateGajiPokok,
                'tunjangan_kerapihan' => $this->tunjangan_groom * $setting->rate_tunjangan_groom,
                'srp'                 => $isSales ? $this->srp * $setting->rate_srp : 0,
                'grosir'              => $isSales ? $this->grosir * $setting->rate_grosir : 0,
                'aksesoris'           => $isSales ? $this->aksesoris * $setting->rate_aksesoris : 0,
                'bonus'               => $this->bonus,
            ],

            'potongan' => [
                'bpjstk'  => $this->hitungPotonganBpjstk($setting),
                'absensi' => $this->absensi * $setting->potongan_absensi,
                'pph21'   => $this->hitungListPph21($employeeId),
            ]
        ];
    }
}
