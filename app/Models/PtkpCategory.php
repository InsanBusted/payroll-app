<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtkpCategory extends Model
{
    use HasFactory;

    protected $table = 'ptkp_categories';

    protected $fillable = [
        'code',
        'description',
    ];



    public function statuses()
    {
        return $this->hasMany(PtkpStatus::class, 'category_id');
    }

    public function terRates()
    {
        return $this->hasMany(TerRate::class, 'category_id');
    }
}
