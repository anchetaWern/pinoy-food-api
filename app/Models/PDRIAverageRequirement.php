<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDRIAverageRequirement extends Model
{
    use HasFactory;

    public $table = 'pdri_average_requirements';

    protected $fillable = [
        'age_from', 'age_to', 'age_type',
        
        'male_protein',
        'female_protein',
        
        'male_vitamin_a',
        'femaale_vitamin_a',

        'male_thiamin',
        'female_thiamin',

        'male_riboflavin',
        'female_riboflavin',

        'male_niacin',
        'female_niacin',

        'male_pyridoxine',
        'female_pyridoxine',

        'male_cobalamin',
        'female_cobalamin',

        'male_folate',
        'female_folate',

        'male_vitamin_c',
        'female_vitamin_c',

        'male_iron',
        'female_iron',

        'male_zinc',
        'female_zinc',

        'male_selenium',
        'female_selenium',

        'male_iodine',
        'female_iodine',
        
        'male_calcium',
        'female_calcium',

        'male_phosphorus',
        'female_phosphorus',
    ];

    protected $visible = [
        'age_from', 'age_to', 'age_type',
        
        'male_protein',
        'female_protein',
        
        'male_vitamin_a',
        'femaale_vitamin_a',

        'male_thiamin',
        'female_thiamin',

        'male_riboflavin',
        'female_riboflavin',

        'male_niacin',
        'female_niacin',

        'male_pyridoxine',
        'female_pyridoxine',

        'male_cobalamin',
        'female_cobalamin',

        'male_folate',
        'female_folate',

        'male_vitamin_c',
        'female_vitamin_c',

        'male_iron',
        'female_iron',

        'male_zinc',
        'female_zinc',

        'male_selenium',
        'female_selenium',

        'male_iodine',
        'female_iodine',
        
        'male_calcium',
        'female_calcium',

        'male_phosphorus',
        'female_phosphorus',
    ];

    public const UNGENDERED_FIELDS = [
        'age_from', 'age_to', 'age_type',
    ];

    public const MALE_FIELDS = [
        'male_protein',
        
        'male_vitamin_a',

        'male_thiamin',

        'male_riboflavin',

        'male_niacin',

        'male_pyridoxine',

        'male_cobalamin',

        'male_folate',

        'male_vitamin_c',

        'male_iron',

        'male_zinc',

        'male_selenium',

        'male_iodine',
        
        'male_calcium',

        'male_phosphorus',
    ];

    public const FEMALE_FIELDS = [
        'female_protein',
        
        'female_vitamin_a',

        'female_thiamin',

        'female_riboflavin',

        'female_niacin',

        'female_pyridoxine',

        'female_cobalamin',

        'female_folate',

        'female_vitamin_c',

        'female_iron',

        'female_zinc',

        'female_selenium',

        'female_iodine',
        
        'female_calcium',

        'female_phosphorus',
    ];
}
