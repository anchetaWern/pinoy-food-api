<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAONutrientReferenceValue extends Model
{
    use HasFactory;

    public $table = 'fao_nutrient_reference_values';

    protected $fillable = [
        'nutrient',
        'daily_value',
        'unit',
    ];
}
