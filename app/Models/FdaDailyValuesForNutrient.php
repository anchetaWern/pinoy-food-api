<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdaDailyValuesForNutrient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nutrient',
        'daily_value',
        'unit',
    ];
}
