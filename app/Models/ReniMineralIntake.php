<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniMineralIntake extends Model
{
    use HasFactory;

    public $table = 'reni_minerals_intake';

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
}
