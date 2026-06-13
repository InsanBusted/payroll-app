<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PkpRate extends Model
{
    use HasFactory;

    protected $table = 'pkp_rates';

    protected $fillable = [
        'start',
        'end',
        'percent',
    ];
}
