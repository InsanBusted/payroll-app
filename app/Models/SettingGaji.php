<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate_tunjangan_groom',
        'rate_srp',
        'rate_grosir',
        'rate_aksesoris',
        'potongan_bpjstk',
        'potongan_absensi',
        'bebas_bpjstk_bulan',
    ];
}
