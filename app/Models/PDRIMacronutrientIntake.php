<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDRIMacronutrientIntake extends Model
{
    use HasFactory;

    public $table = 'pdri_macronutrient_intake';

    protected $fillable = [
        'age_from',
        'age_to',
        'age_type',

        'male_protein_in_grams',
        'female_protein_in_grams',

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

        'male_protein_in_grams',
        'female_protein_in_grams',

        'linolenic_acid',
        'linoleic_acid',

        'fiber_from_in_grams',
        'fiber_to_in_grams',

        'male_water_in_ml',
        'female_water_in_ml',
    ];

    public const MALE_FIELDS = [
        'male_protein_in_grams',
        'male_water_in_ml', 
    ];

    public const FEMALE_FIELDS = [
        'female_protein_in_grams',
        'female_water_in_ml', 
    ];

    public const UNGENDERED_FIELDS = [
        'age_type',
        'age_from',
        'age_to',
        'linolenic_acid', 'linoleic_acid',
        'fiber_from_in_grams', 'fiber_to_in_grams'
    ];
}
