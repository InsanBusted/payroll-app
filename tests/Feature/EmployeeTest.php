<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_employee_with_join_date(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/employees', [
            'nik' => 'EMP999',
            'nama' => 'John Doe',
            'join_date' => '2026-01-01',
        ]);

        $response->assertRedirect('/employees');
        $this->assertDatabaseHas('employees', [
            'nik' => 'EMP999',
            'nama' => 'John Doe',
            'join_date' => '2026-01-01',
        ]);
    }

    public function test_can_update_employee_with_join_date(): void
    {
        $user = User::factory()->create();
        $employee = Employee::create([
            'nik' => 'EMP999',
            'nama' => 'John Doe',
            'join_date' => '2025-12-31',
        ]);

        $response = $this->actingAs($user)->put('/employees/' . $employee->id, [
            'nik' => 'EMP999',
            'nama' => 'John Doe Updated',
            'join_date' => '2026-01-01',
        ]);

        $response->assertRedirect('/employees');
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'nama' => 'John Doe Updated',
            'join_date' => '2026-01-01',
        ]);
    }
}
