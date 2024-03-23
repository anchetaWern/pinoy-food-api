<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniAverageRequirement extends Model
{
    use HasFactory;

    public $table = 'reni_average_requirements';

    protected $fillable = [
        'age_from',
        'age_to',
        
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
}
