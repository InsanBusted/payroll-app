<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerRate extends Model
{
    use HasFactory;

    protected $table = 'ter_rates';

    protected $fillable = [
        'category_id',
        'min_salary',
        'max_salary',
        'rate',
    ];

    protected $casts = [
        'min_salary' => 'integer',
        'max_salary' => 'integer',
        'rate'       => 'decimal:4',
    ];


    public function category()
    {
        return $this->belongsTo(PtkpCategory::class, 'category_id');
    }



    public function scopeForSalary($query, $salary)
    {
        return $query->where('min_salary', '<=', $salary)
            ->where(function ($q) use ($salary) {
                $q->where('max_salary', '>=', $salary)
                    ->orWhereNull('max_salary');
            });
    }



    public static function getRate($categoryId, $salary)
    {
        return self::query()->where('category_id', $categoryId)
            ->forSalary($salary)
            ->first();
    }
}
