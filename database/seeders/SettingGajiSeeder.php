<?php

namespace Database\Seeders;

use App\Models\SettingGaji;
use Illuminate\Database\Seeder;

class SettingGajiSeeder extends Seeder
{
    public function run(): void
    {
        SettingGaji::truncate();

        SettingGaji::create([
            'rate_gaji_pokok' => 30000,
            'rate_tunjangan_groom' => 10000,
            'rate_srp' => 30000,
            'rate_grosir' => 10000,
            'rate_aksesoris' => 5000,
            'potongan_bpjstk' => 50000,
            'potongan_absensi' => 10000,
        ]);

        $this->command->info('✅ Setting Master Gaji berhasil di-seed (Rate default sesuai request).');
    }
}
