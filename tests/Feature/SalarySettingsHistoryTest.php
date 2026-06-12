<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\EmployeeKinerja;
use App\Models\SettingGaji;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalarySettingsHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_salary_calculation_uses_historical_rates(): void
    {
        // 1. Setup default settings
        $setting = SettingGaji::create([
            'rate_tunjangan_groom' => 10000,
            'rate_srp' => 30000,
            'rate_grosir' => 10000,
            'rate_aksesoris' => 5000,
            'potongan_bpjstk' => 50000,
            'potongan_absensi' => 10000,
            'bebas_bpjstk_bulan' => 3,
        ]);

        $jabatan = Jabatan::create([
            'nama' => 'Sales Staff',
            'rate_gaji_pokok' => 100000,
        ]);

        $employee = Employee::create([
            'nik' => 'EMP123',
            'nama' => 'Test Employee',
            'jabatan_id' => $jabatan->id,
            'join_date' => '2026-01-01',
        ]);

        // 2. Create kinerja record with the current settings (e.g. rate_tunjangan_groom = 10000)
        $kinerja = EmployeeKinerja::create([
            'employee_id' => $employee->id,
            'periode' => '2026-06',
            'total_hadir' => 10,
            'tunjangan_groom' => 2, // 2 * 10000 = 20000
            'srp' => 1,            // 1 * 30000 = 30000
            'grosir' => 0,
            'aksesoris' => 0,
            'bonus' => 0,
            'bpjstk' => 0,
            'absensi' => 0,
            'pph21' => 0,
        ]);

        // Calculation: 10 * 100000 (gaji pokok) + 2 * 10000 (groom) + 1 * 30000 (srp) = 1,000,000 + 20,000 + 30,000 = 1,050,000
        $this->assertEquals(1050000, $kinerja->hitungTotalPendapatan());

        // 3. Update active salary settings
        $setting->update([
            'rate_tunjangan_groom' => 15000,
            'rate_srp' => 40000,
        ]);

        // 4. Reload kinerja and check if the total remains unchanged (1,050,000)
        $kinerja = $kinerja->fresh();
        $this->assertEquals(1050000, $kinerja->hitungTotalPendapatan());

        // 5. Create a new kinerja record for next period and verify it uses the new rates (15000 and 40000)
        $newKinerja = EmployeeKinerja::create([
            'employee_id' => $employee->id,
            'periode' => '2026-07',
            'total_hadir' => 10,
            'tunjangan_groom' => 2, // 2 * 15000 = 30000
            'srp' => 1,            // 1 * 40000 = 40000
            'grosir' => 0,
            'aksesoris' => 0,
            'bonus' => 0,
            'bpjstk' => 0,
            'absensi' => 0,
            'pph21' => 0,
        ]);

        // Calculation: 10 * 100000 (gaji pokok) + 2 * 15000 (groom) + 1 * 40000 (srp) = 1,000,000 + 30,000 + 40,000 = 1,070,000
        $this->assertEquals(1070000, $newKinerja->hitungTotalPendapatan());
    }
}
