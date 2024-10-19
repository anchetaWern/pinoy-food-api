<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDRIMineralIntake extends Model
{
    use HasFactory;

    public $table = 'pdri_minerals_intake';

    protected $fillable = [

        'age_from', 'age_to', 'age_type',

        'male_iron', 'female_iron',

        'male_zinc', 'female_zinc',

        'male_selenium', 'female_selenium',
        
        'male_iodine', 'female_iodine',

        'male_calcium', 'female_calcium',
        
        'male_magnesium', 'female_magnesium',

        'male_phosphorus', 'female_phosphorus',

        'male_fluoride', 'female_fluoride',

        'sodium',
        'chloride',
        'potassium',
    ];

    protected $visible = [
        'age_from', 'age_to', 'age_type',

        'male_iron', 'female_iron',

        'male_zinc', 'female_zinc',

        'male_selenium', 'female_selenium',
        
        'male_iodine', 'female_iodine',

        'male_calcium', 'female_calcium',
        
        'male_magnesium', 'female_magnesium',

        'male_phosphorus', 'female_phosphorus',

        'male_fluoride', 'female_fluoride',

        'sodium',
        'chloride',
        'potassium',
    ];

    public const MALE_FIELDS = [
        'male_iron',
        'male_zinc',
        'male_selenium',
        'male_iodine',
        'male_calcium',
        'male_magnesium',
        'male_phosphorus',
        'male_fluoride',
    ];

    public const FEMALE_FIELDS = [
        'female_iron',
        'female_zinc',
        'female_selenium',
        'female_iodine',
        'female_calcium',
        'female_magnesium',
        'female_phosphorus',
        'female_fluoride',
    ];

    public const UNGENDERED_FIELDS = [
        'age_from', 'age_to', 'age_type',
        'sodium',
        'chloride',
        'potassium',
    ];
}
