<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniVitaminIntake extends Model
{
    use HasFactory;

    public $table = 'reni_vitamins_intake';

    protected $fillable = [
        'age_from',
        'age_to',

        'age_type',

        'male_energy_req_in_kcal',
        'female_energy_req_in_kcal',

        'male_weight_in_kg',
        'female_weight_in_kg',

        'male_protein_in_g',
        'female_protein_in_g',

        'male_vitamin_a',
        'female_vitamin_a',

        'male_vitamin_c',
        'female_vitamin_c',

        'male_vitamin_b1',
        'female_vitamin_b1', 

        'male_vitamin_b2',
        'female_vitamin_b2',

        'male_vitamin_b3',
        'female_vitamin_b3',

        'male_vitamin_b9',
        'female_vitamin_b9',

        'male_vitamin_d',
        'female_vitamin_d',

        'male_vitamin_e',
        'female_vitamin_e',

        'male_vitamin_k',
        'female_vitamin_k',

        'male_vitamin_b6',
        'female_vitamin_b6',

        'male_vitamin_b12',
        'female_vitamin_b12'
    ];

    protected $visible = [
        'age_from',
        'age_to',

        'age_type',

        'male_energy_req_in_kcal',
        'female_energy_req_in_kcal',

        'male_weight_in_kg',
        'female_weight_in_kg',

        'male_protein_in_g',
        'female_protein_in_g',

        'male_vitamin_a',
        'female_vitamin_a',

        'male_vitamin_c',
        'female_vitamin_c',

        'male_vitamin_b1',
        'female_vitamin_b1', 

        'male_vitamin_b2',
        'female_vitamin_b2',

        'male_vitamin_b3',
        'female_vitamin_b3',

        'male_vitamin_b9',
        'female_vitamin_b9',

        'male_vitamin_d',
        'female_vitamin_d',

        'male_vitamin_e',
        'female_vitamin_e',

        'male_vitamin_k',
        'female_vitamin_k',

        'male_vitamin_b6',
        'female_vitamin_b6',

        'male_vitamin_b12',
        'female_vitamin_b12'

    ];


    public const UNGENDERED_FIELDS = [
        'age_from',
        'age_to',

        'age_type',
    ];

    public const MALE_FIELDS = [
        'male_energy_req_in_kcal',
        'male_weight_in_kg',
        'male_protein_in_g',
        'male_vitamin_a',
        'male_vitamin_c',
        'male_vitamin_b1',
        'male_vitamin_b2',
        'male_vitamin_b3',
        'male_vitamin_b9',
        'male_vitamin_d',
        'male_vitamin_e',
        'male_vitamin_k',
        'male_vitamin_b6',
        'male_vitamin_b12',
    ];

    public const FEMALE_FIELDS = [
        'female_energy_req_in_kcal',
        'female_weight_in_kg',
        'female_protein_in_g',
        'female_vitamin_a',
        'female_vitamin_c',
        'female_vitamin_b1',
        'female_vitamin_b2',
        'female_vitamin_b3',
        'female_vitamin_b9',
        'female_vitamin_d',
        'female_vitamin_e',
        'female_vitamin_k',
        'female_vitamin_b6',
        'female_vitamin_b12',
    ];
}
