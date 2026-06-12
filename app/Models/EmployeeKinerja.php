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
        'status_diterima',
        'rate_gaji_pokok',
        'rate_tunjangan_groom',
        'rate_srp',
        'rate_grosir',
        'rate_aksesoris',
        'potongan_bpjstk',
        'potongan_absensi',
        'bebas_bpjstk_bulan',
    ];

    protected static function booted()
    {
        static::saving(function ($kinerja) {
            $setting = SettingGaji::first();
            $employee = Employee::with('jabatan')->find($kinerja->employee_id);

            if ($kinerja->rate_tunjangan_groom === null && $setting) {
                $kinerja->rate_tunjangan_groom = $setting->rate_tunjangan_groom;
            }
            if ($kinerja->rate_srp === null && $setting) {
                $kinerja->rate_srp = $setting->rate_srp;
            }
            if ($kinerja->rate_grosir === null && $setting) {
                $kinerja->rate_grosir = $setting->rate_grosir;
            }
            if ($kinerja->rate_aksesoris === null && $setting) {
                $kinerja->rate_aksesoris = $setting->rate_aksesoris;
            }
            if ($kinerja->potongan_bpjstk === null && $setting) {
                $kinerja->potongan_bpjstk = $setting->potongan_bpjstk;
            }
            if ($kinerja->potongan_absensi === null && $setting) {
                $kinerja->potongan_absensi = $setting->potongan_absensi;
            }
            if ($kinerja->bebas_bpjstk_bulan === null && $setting) {
                $kinerja->bebas_bpjstk_bulan = $setting->bebas_bpjstk_bulan ?? 3;
            }

            if ($kinerja->rate_gaji_pokok === null && $employee && $employee->jabatan) {
                $kinerja->rate_gaji_pokok = $employee->jabatan->rate_gaji_pokok;
            }
        });
    }

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
        $employee = $this->employee ?? Employee::with('jabatan')->find($this->employee_id);
        if (!$employee || !$employee->jabatan) {
            return 0;
        }

        // Use stored rates if available, otherwise fallback to current settings
        $rateGajiPokok = $this->rate_gaji_pokok ?? $employee->jabatan->rate_gaji_pokok;
        
        $setting = null;
        if ($this->rate_tunjangan_groom === null) {
            $setting = SettingGaji::first();
        }

        $rateTunjanganGroom  = $this->rate_tunjangan_groom ?? ($setting ? $setting->rate_tunjangan_groom : 0);
        $rateSrp             = $this->rate_srp ?? ($setting ? $setting->rate_srp : 0);
        $rateGrosir          = $this->rate_grosir ?? ($setting ? $setting->rate_grosir : 0);
        $rateAksesoris       = $this->rate_aksesoris ?? ($setting ? $setting->rate_aksesoris : 0);
        $potonganAbsensiRate = $this->potongan_absensi ?? ($setting ? $setting->potongan_absensi : 0);

        $isSales = stripos($employee->jabatan->nama, 'sales') !== false
                || stripos($employee->jabatan->nama, 'kepala toko') !== false;

        $gajiPokok          = $this->total_hadir * $rateGajiPokok;
        $tunjanganKerapihan = $this->tunjangan_groom * $rateTunjanganGroom;
        $valueSrp           = $isSales ? $this->srp * $rateSrp : 0;
        $valueGrosir        = $isSales ? $this->grosir * $rateGrosir : 0;
        $valueAksesoris     = $isSales ? $this->aksesoris * $rateAksesoris : 0;
        $potonganAbsensi    = $this->absensi * $potonganAbsensiRate;

        $gajiTotal = ($gajiPokok
            + $tunjanganKerapihan
            + $valueSrp
            + $valueGrosir
            + $valueAksesoris
            + $this->bonus) - $potonganAbsensi;

        return $gajiTotal;
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
        $potonganPph21 = $this->hitungTotalPph21();

        return $this->hitungPotonganBpjstk() + $potonganPph21;
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
    private function hitungPotonganBpjstk(?SettingGaji $setting = null): int
    {
        $employee = $this->employee ?? Employee::find($this->employee_id);
        if (!$employee || !$employee->join_date) {
            return 0;
        }

        $masaKerja = Carbon::parse($employee->join_date)->diffInMonths(now());
        
        $bebasSampai = $this->bebas_bpjstk_bulan;
        $potonganBpjstk = $this->potongan_bpjstk;
        
        if ($bebasSampai === null || $potonganBpjstk === null) {
            if (!$setting) {
                $setting = SettingGaji::first();
            }
            if ($setting) {
                if ($bebasSampai === null) $bebasSampai = $setting->bebas_bpjstk_bulan ?? 3;
                if ($potonganBpjstk === null) $potonganBpjstk = $setting->potongan_bpjstk;
            }
        }

        $bebasSampai = $bebasSampai ?? 3;
        $potonganBpjstk = $potonganBpjstk ?? 0;

        return $masaKerja >= $bebasSampai ? $potonganBpjstk : 0;
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
        $employee = $this->employee ?? Employee::with('jabatan')->find($this->employee_id);

        if (!$employee || !$employee->jabatan) {
            return [];
        }

        $setting = null;
        if ($this->rate_tunjangan_groom === null) {
            $setting = SettingGaji::first();
        }

        $rateGajiPokok      = $this->rate_gaji_pokok ?? ($employee->jabatan->rate_gaji_pokok ?? 0);
        $rateTunjanganGroom = $this->rate_tunjangan_groom ?? ($setting ? $setting->rate_tunjangan_groom : 0);
        $rateSrp            = $this->rate_srp ?? ($setting ? $setting->rate_srp : 0);
        $rateGrosir         = $this->rate_grosir ?? ($setting ? $setting->rate_grosir : 0);
        $rateAksesoris      = $this->rate_aksesoris ?? ($setting ? $setting->rate_aksesoris : 0);
        $potonganAbsensiRate = $this->potongan_absensi ?? ($setting ? $setting->potongan_absensi : 0);

        $isSales = stripos($employee->jabatan->nama, 'sales') !== false
                || stripos($employee->jabatan->nama, 'kepala toko') !== false;

        return [
            'pendapatan' => [
                'gaji_pokok'          => $this->total_hadir * $rateGajiPokok,
                'tunjangan_kerapihan' => $this->tunjangan_groom * $rateTunjanganGroom,
                'srp'                 => $isSales ? $this->srp * $rateSrp : 0,
                'grosir'              => $isSales ? $this->grosir * $rateGrosir : 0,
                'aksesoris'           => $isSales ? $this->aksesoris * $rateAksesoris : 0,
                'bonus'               => $this->bonus,
            ],
            'potongan' => [
                'bpjstk'  => $this->hitungPotonganBpjstk($setting),
                'absensi' => $this->absensi * $potonganAbsensiRate,
                'pph21'   => $this->hitungListPph21($this->employee_id),
            ]
        ];
    }

    public function rincianGajiList($employeeId): array
    {
        $employee = Employee::with('jabatan')
            ->where('id', $employeeId)
            ->first();

        if (!$employee || !$employee->jabatan) {
            return [];
        }

        $setting = null;
        if ($this->rate_tunjangan_groom === null) {
            $setting = SettingGaji::first();
        }

        $rateGajiPokok      = $this->rate_gaji_pokok ?? ($employee->jabatan->rate_gaji_pokok ?? 0);
        $rateTunjanganGroom = $this->rate_tunjangan_groom ?? ($setting ? $setting->rate_tunjangan_groom : 0);
        $rateSrp            = $this->rate_srp ?? ($setting ? $setting->rate_srp : 0);
        $rateGrosir         = $this->rate_grosir ?? ($setting ? $setting->rate_grosir : 0);
        $rateAksesoris      = $this->rate_aksesoris ?? ($setting ? $setting->rate_aksesoris : 0);
        $potonganAbsensiRate = $this->potongan_absensi ?? ($setting ? $setting->potongan_absensi : 0);

        $isSales = stripos($employee->jabatan->nama, 'sales') !== false
                || stripos($employee->jabatan->nama, 'kepala toko') !== false;

        return [
            'pendapatan' => [
                'gaji_pokok'          => $this->total_hadir * $rateGajiPokok,
                'tunjangan_kerapihan' => $this->tunjangan_groom * $rateTunjanganGroom,
                'srp'                 => $isSales ? $this->srp * $rateSrp : 0,
                'grosir'              => $isSales ? $this->grosir * $rateGrosir : 0,
                'aksesoris'           => $isSales ? $this->aksesoris * $rateAksesoris : 0,
                'bonus'               => $this->bonus,
            ],

            'potongan' => [
                'bpjstk'  => $this->hitungPotonganBpjstk($setting),
                'absensi' => $this->absensi * $potonganAbsensiRate,
                'pph21'   => $this->hitungListPph21($employeeId),
            ]
        ];
    }
}
