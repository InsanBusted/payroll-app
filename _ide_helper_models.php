<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Area whereUpdatedAt($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $user_id
 * @property string $nik
 * @property string $nama
 * @property int|null $jabatan_id
 * @property int|null $area_id
 * @property string|null $no_rek_bank
 * @property string|null $nama_bank
 * @property string|null $signature_path Path file tanda tangan digital untuk keperluan export PDF/slip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\Jabatan|null $jabatan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmployeeKinerja> $kinerjas
 * @property-read int|null $kinerjas_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereJabatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNoRekBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereSignaturePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUserId($value)
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property string $periode Format: YYYY-MM
 * @property int $total_hadir
 * @property int $tunjangan_groom
 * @property int $srp
 * @property int $grosir
 * @property int $aksesoris
 * @property int $bonus Bonus tambahan (Nominal)
 * @property int $bpjstk
 * @property int $absensi
 * @property int $pph21
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereAbsensi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereAksesoris($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereBpjstk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereGrosir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja wherePph21($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereSrp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereTotalHadir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereTunjanganGroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeKinerja whereUpdatedAt($value)
 */
	class EmployeeKinerja extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Jabatan whereUpdatedAt($value)
 */
	class Jabatan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $rate_gaji_pokok Rate per hari hadir
 * @property int $rate_tunjangan_groom Rate per point tunjangan groom
 * @property int $rate_srp Rate per point SRP
 * @property int $rate_grosir Rate per point Grosir
 * @property int $rate_aksesoris Rate per point Aksesoris
 * @property int $potongan_bpjstk Potongan tetap BPJSTK
 * @property int $potongan_absensi Potongan per hari absen/telat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji wherePotonganAbsensi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji wherePotonganBpjstk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereRateAksesoris($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereRateGajiPokok($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereRateGrosir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereRateSrp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereRateTunjanganGroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingGaji whereUpdatedAt($value)
 */
	class SettingGaji extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $role_id
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

