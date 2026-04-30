<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtkpStatus extends Model
{
    use HasFactory;

    protected $table = 'ptkp_statuses';

    protected $fillable = [
        'status',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(PtkpCategory::class, 'category_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'ptkp_status_id');
    }
}
