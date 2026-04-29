<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Employee;
use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Roles ────────────────────────────────────────────────────
        $superadminRole = Role::create(['name'=>'superadmin', 'display_name'=>'Super Admin',  'description'=>'Full system access including user management']);
        $adminRole      = Role::create(['name'=>'admin',      'display_name'=>'Administrator', 'description'=>'Full access to all modules']);
        $financeRole    = Role::create(['name'=>'finance',    'display_name'=>'Finance',       'description'=>'Manages payroll and salary reports']);
        $employeeRole   = Role::create(['name'=>'employee',   'display_name'=>'Employee',      'description'=>'Can view own salary slips']);

        // ── 2. Jabatan ──────────────────────────────────────────────────
        $jabatans = [
            ['nama'=>'Manager',          'deskripsi'=>'Pimpinan departemen'],
            ['nama'=>'Staff Keuangan',   'deskripsi'=>'Pengelola keuangan dan penggajian'],
            ['nama'=>'Staff Operasional','deskripsi'=>'Pelaksana kegiatan operasional'],
            ['nama'=>'Supervisor',       'deskripsi'=>'Pengawas lapangan'],
            ['nama'=>'HRD',              'deskripsi'=>'Pengelola sumber daya manusia'],
        ];
        foreach ($jabatans as $j) Jabatan::create($j);

        // ── 3. Area ─────────────────────────────────────────────────────
        $areas = [
            ['nama'=>'Jakarta Pusat',  'deskripsi'=>'Kantor pusat'],
            ['nama'=>'Jakarta Selatan','deskripsi'=>'Cabang selatan'],
            ['nama'=>'Bandung',        'deskripsi'=>'Cabang Bandung'],
            ['nama'=>'Surabaya',       'deskripsi'=>'Cabang Surabaya'],
        ];
        foreach ($areas as $a) Area::create($a);

        // ── 4. Users ────────────────────────────────────────────────────
        User::create([
            'name'    =>'Super Admin',
            'email'   =>'superadmin@gmail.com',
            'password'=>Hash::make('password123'),
            'role_id' =>$superadminRole->id,
        ]);
        $adminUser = User::create([
            'name'    =>'Admin',
            'email'   =>'admin@gmail.com',
            'password'=>Hash::make('password123'),
            'role_id' =>$adminRole->id,
        ]);
        $financeUser = User::create([
            'name'    =>'Finance Staff',
            'email'   =>'finance@gmail.com',
            'password'=>Hash::make('password123'),
            'role_id' =>$financeRole->id,
        ]);
        $empUser = User::create([
            'name'    =>'Budi Santoso',
            'email'   =>'user@gmail.com',
            'password'=>Hash::make('password123'),
            'role_id' =>$employeeRole->id,
        ]);

        // ── 5. Employees ─────────────────────────────────────────────────
        Employee::create([
            'user_id'    =>$financeUser->id,
            'nik'        =>'EMP001',
            'nama'       =>'Finance Staff',
            'jabatan_id' =>Jabatan::where('nama','Staff Keuangan')->first()->id,
            'area_id'    =>Area::where('nama','Jakarta Pusat')->first()->id,
            'no_rek_bank'=>'1234567890',
            'nama_bank'  =>'BCA',
        ]);
        Employee::create([
            'user_id'    =>$empUser->id,
            'nik'        =>'EMP002',
            'nama'       =>'Budi Santoso',
            'jabatan_id' =>Jabatan::where('nama','Staff Operasional')->first()->id,
            'area_id'    =>Area::where('nama','Bandung')->first()->id,
            'no_rek_bank'=>'0987654321',
            'nama_bank'  =>'Mandiri',
        ]);

        // ── 6. Bulk Employee Users ───────────────────────────────────────
        $this->call(EmployeeUserSeeder::class);

        // ── 7. Setting Gaji ─────────────────────────────────────────────
        $this->call(SettingGajiSeeder::class);
    }
}
