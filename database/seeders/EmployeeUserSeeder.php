<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeUserSeeder extends Seeder
{
    /**
     * Default password untuk semua akun karyawan.
     */
    const DEFAULT_PASSWORD = 'password123';

    /**
     * Daftar nama karyawan.
     */
    protected array $names = [
        'AGUS INSANI',
        'AHMAD IMAM SYAFEI',
        'AHMAD RAMZI',
        'CHINTHYA RETMITA LARAS',
        'EPA KURNIA',
        'GALIH HARDIANTO RAMADANI',
        'M. BUKHORI A',
        'M. RIZKI NURFAHMI',
        'MOHAMAD ZAELANI',
        'MONALISA',
        'MUHAMAD FAISAL',
        'MUHAMAD SOLEH',
        'MUHAMMAD BAYU ADAM',
        'MUHAMMAD FIKRAM ALFARIZA',
        'MUHAMMAD HABIBI THAMRIN',
        'REYNALDI AHMAD DARMAWAN',
        'REYSHA AIDIL PRATAMA',
        'RISKI KURNIAWAN',
        'RYAWAN RUSWAN',
        'SAIPUL IMRON',
        'SASYA NURSHAKILA',
        'SEVRI NANDA',
        'VERONICA OCTADYANINGTYAS',
        'WILDAN ALIV MONDRIAN',
        'ALI REZA ADAMY',
        'KANDAR',
        'ASRI HANDAYANI',
        'M. HARITSYAH',
        'MUHAMAD KODRI',
        'ELSA FITRI',
        'NIA YUNIA',
        'MARTINUS RISWANTO GULTOM',
        'RINI NURLAELA',
        'REVIADAM MAULANA ZEIN',
        'NAZWA LUTFIAH GUNTUR',
        'ARI GUNAWAN',
        'TIARA APRIANTI',
        'FAHRI IRSADUL IBAD',
        'ANDRA KURNIAWAN',
        'MALVIN VALERIAN',
        'ALSYA RISMADANI',
        'ANDIKA',
        'ANDRIAN TARUMA SELEJ',
        'IKMAL AKBAR',
        'HERLAN',
        'KHEIZA KURNIAWAN',
        'HARJIYANTO',
        'ANGGA KUSUMA',
        'FADHIL ANHAR',
        'DEASY NURAENI',
        'EGI PRAYOGA',
        'ANGGI ADE IRAWAN',
        'ARYA RAMADHANI',
        'BASKORO BINA NUSWANTORO',
        'ROSYADAH NURAZIZAH',
        'CHINDY IKA HARTATI',
        'RISQI FEBRIANI',
        'ALI AKBAR',
        'SELA ANINDITA',
        'LINGGA RAMADHAN',
        'ZAHRA SABRINA',
    ];

    public function run(): void
    {
        $employeeRole = Role::where('name', 'employee')->firstOrFail();
        $password     = Hash::make(self::DEFAULT_PASSWORD);

        foreach ($this->names as $index => $name) {
            // Build email: lowercase, dots between words, strip dots in abbreviations
            $slug  = Str::of($name)
                ->lower()
                ->replace('.', '')   // remove abbreviation dots (M. → m)
                ->replace(' ', '.')  // spaces → dots
                ->toString();

            $email = $slug . '@payroll.com';

            // Ensure unique email if duplicate slug exists
            $emailBase = $email;
            $suffix    = 1;
            while (User::where('email', $email)->exists()) {
                $email = $emailBase . $suffix++;
            }

            // Generate NIK: EMP + zero-padded 3-digit index
            $nik = 'EMP' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            while (Employee::where('nik', $nik)->exists()) {
                $nik = 'EMP' . str_pad($index + 100, 3, '0', STR_PAD_LEFT);
            }

            // Create User
            $user = User::create([
                'name'     => ucwords(strtolower($name)),
                'email'    => $email,
                'password' => $password,
                'role_id'  => $employeeRole->id,
            ]);

            // Create linked Employee record
            Employee::create([
                'user_id' => $user->id,
                'nik'     => $nik,
                'nama'    => $name,
            ]);
        }

        $this->command->info('✅ ' . count($this->names) . ' akun karyawan berhasil dibuat (password: ' . self::DEFAULT_PASSWORD . ')');
    }
}
