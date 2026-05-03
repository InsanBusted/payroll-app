<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'rate_gaji_pokok'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
