<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'nama',
        'jabatan_id',
        'area_id',
        'no_rek_bank',
        'nama_bank',
        'signature_path',
        'join_date',
        'ptkp_status_id',
        'ptkp_17_status_id',
        'status_karyawan',
    ];

    protected static function booted()
    {
        static::creating(function ($employee) {
            if (empty($employee->join_date)) {
                $employee->join_date = now()->toDateString();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function kinerjas()
    {
        return $this->hasMany(EmployeeKinerja::class);
    }

    public function ptkpStatus()
    {
        return $this->belongsTo(PtkpStatus::class);
    }

    public function ptkp17Status()
    {
        return $this->belongsTo(Ptkp17Status::class, 'ptkp_17_status_id');
    }
}
