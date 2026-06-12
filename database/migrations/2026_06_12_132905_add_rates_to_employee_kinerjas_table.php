<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->integer('rate_gaji_pokok')->nullable()->after('total_hadir');
            $table->integer('rate_tunjangan_groom')->nullable()->after('tunjangan_groom');
            $table->integer('rate_srp')->nullable()->after('srp');
            $table->integer('rate_grosir')->nullable()->after('grosir');
            $table->integer('rate_aksesoris')->nullable()->after('aksesoris');
            $table->integer('potongan_bpjstk')->nullable()->after('bpjstk');
            $table->integer('potongan_absensi')->nullable()->after('absensi');
            $table->integer('bebas_bpjstk_bulan')->nullable()->after('potongan_bpjstk');
        });

        // Populate existing records with current rates
        $setting = DB::table('setting_gajis')->first();
        if ($setting) {
            $kinerjas = DB::table('employee_kinerjas')->get();
            foreach ($kinerjas as $kinerja) {
                // Get employee's jabatan rate_gaji_pokok
                $employee = DB::table('employees')
                    ->join('jabatans', 'employees.jabatan_id', '=', 'jabatans.id')
                    ->where('employees.id', $kinerja->employee_id)
                    ->select('jabatans.rate_gaji_pokok')
                    ->first();

                $rateGajiPokok = $employee ? $employee->rate_gaji_pokok : 0;

                DB::table('employee_kinerjas')
                    ->where('id', $kinerja->id)
                    ->update([
                        'rate_gaji_pokok' => $rateGajiPokok,
                        'rate_tunjangan_groom' => $setting->rate_tunjangan_groom,
                        'rate_srp' => $setting->rate_srp,
                        'rate_grosir' => $setting->rate_grosir,
                        'rate_aksesoris' => $setting->rate_aksesoris,
                        'potongan_bpjstk' => $setting->potongan_bpjstk,
                        'potongan_absensi' => $setting->potongan_absensi,
                        'bebas_bpjstk_bulan' => $setting->bebas_bpjstk_bulan ?? 3,
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->dropColumn([
                'rate_gaji_pokok',
                'rate_tunjangan_groom',
                'rate_srp',
                'rate_grosir',
                'rate_aksesoris',
                'potongan_bpjstk',
                'potongan_absensi',
                'bebas_bpjstk_bulan',
            ]);
        });
    }
};
