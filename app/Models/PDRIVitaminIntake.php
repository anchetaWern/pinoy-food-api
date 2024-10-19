<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDRIVitaminIntake extends Model
{
    use HasFactory;

    public $table = 'pdri_vitamins_intake';

    protected $fillable = [
        'age_from', 'age_to', 'age_type',
        'male_vitamin_a', 'female_vitamin_a',
        'male_vitamin_d', 'female_vitamin_d',
        'male_vitamin_e', 'female_vitamin_e',
        'male_vitamin_k', 'female_vitamin_k',
        'male_thiamin', 'female_thiamin',
        'male_riboflavin', 'female_riboflavin',
        'male_niacin', 'female_niacin',
        'male_pyridoxine', 'female_pyridoxine',
        'male_cobalamin', 'female_cobalamin',
        'male_folate', 'female_folate',
        'male_vitamin_c', 'female_vitamin_c',
    ];

    protected $visible = [
        'age_from', 'age_to', 'age_type',
        'male_vitamin_a', 'female_vitamin_a',
        'male_vitamin_d', 'female_vitamin_d',
        'male_vitamin_e', 'female_vitamin_e',
        'male_vitamin_k', 'female_vitamin_k',
        'male_thiamin', 'female_thiamin',
        'male_riboflavin', 'female_riboflavin',
        'male_niacin', 'female_niacin',
        'male_pyridoxine', 'female_pyridoxine',
        'male_cobalamin', 'female_cobalamin',
        'male_folate', 'female_folate',
        'male_vitamin_c', 'female_vitamin_c',
    ];

    public const MALE_FIELDS = [
        'male_vitamin_a',
        'male_vitamin_d',
        'male_vitamin_e',
        'male_vitamin_k',
        'male_thiamin',
        'male_riboflavin',
        'male_niacin',
        'male_pyridoxine',
        'male_cobalamin',
        'male_folate',
        'male_vitamin_c',
    ];

    public const FEMALE_FIELDS = [
        'female_vitamin_a',
        'female_vitamin_d',
        'female_vitamin_e',
        'female_vitamin_k',
        'female_thiamin',
        'female_riboflavin',
        'female_niacin',
        'female_pyridoxine',
        'female_cobalamin',
        'female_folate',
        'female_vitamin_c',
    ];

    public const UNGENDERED_FIELDS = [
        'age_from', 'age_to', 'age_type',
    ];
}
