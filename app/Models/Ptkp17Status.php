<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptkp17Status extends Model
{
    use HasFactory;

    protected $table = 'ptkp_17_statuses';

    protected $fillable = [
        'status',
        'ptkp_setahun',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'ptkp_17_status_id');
    }
}
