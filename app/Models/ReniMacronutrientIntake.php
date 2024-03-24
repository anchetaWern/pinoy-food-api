<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniMacronutrientIntake extends Model
{
    use HasFactory;

    public $table = 'reni_macronutrient_intake';

    protected $fillable = [
        'age_from',
        'age_to',
        'age_type',

        'protein_from_in_grams',
        'protein_to_in_grams',

        'linolenic_acid',
        'linoleic_acid',

        'fiber_from_in_grams',
        'fiber_to_in_grams',

        'male_water_in_ml',
        'female_water_in_ml',
    ];

    protected $visible = [
        'age_from',
        'age_to',
        'age_type',

        'protein_from_in_grams',
        'protein_to_in_grams',

        'linolenic_acid',
        'linoleic_acid',

        'fiber_from_in_grams',
        'fiber_to_in_grams',

        'male_water_in_ml',
        'female_water_in_ml',
    ];
}
