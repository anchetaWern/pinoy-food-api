<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAONutrientConditionsReferenceValue extends Model
{
    use HasFactory;

    public $table = 'fao_nutrient_conditions_reference_values';

    public $timestamps = false;

    protected $fillable = [
        'claim_id',
        'reference_id',
    ];
}
