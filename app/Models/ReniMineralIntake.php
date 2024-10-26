<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniMineralIntake extends Model
{
    use HasFactory;

    public $table = 'reni_minerals_intake';

    protected $fillable = [

        'age_from', 
        'age_to',
        'age_type',

        'male_weight_in_kg', 
        'female_weight_in_kg',
        
        'male_calcium', 
        'female_calcium',
        
        'male_iron', 
        'female_iron',
        
        'male_iodine', 
        'female_iodine',
        
        'male_magnesium', 
        'female_magnesium',
        
        'male_phosphorus', 
        'female_phosphorus',
        
        'male_zinc', 
        'female_zinc',
        
        'male_selenium', 
        'female_selenium',
        
        'male_fluoride', 
        'female_fluoride',
        
        'male_manganese', 
        'female_manganese', 
    ];

    protected $visible = [
        'age_from', 
        'age_to',
        'age_type',

        'male_weight_in_kg', 
        'female_weight_in_kg',
        
        'male_calcium', 
        'female_calcium',
        
        'male_iron', 
        'female_iron',
        
        'male_iodine', 
        'female_iodine',
        
        'male_magnesium', 
        'female_magnesium',
        
        'male_phosphorus', 
        'female_phosphorus',
        
        'male_zinc', 
        'female_zinc',
        
        'male_selenium', 
        'female_selenium',
        
        'male_fluoride', 
        'female_fluoride',
        
        'male_manganese', 
        'female_manganese', 
    ];

    public const UNGENDERED_FIELDS = [
        'age_from', 
        'age_to',
        'age_type',
    ];

    public const MALE_FIELDS = [
        'male_weight_in_kg', 
        'male_calcium', 
        'male_iron', 
        'male_iodine', 
        'male_magnesium', 
        'male_phosphorus', 
        'male_zinc', 
        'male_selenium', 
        'male_fluoride', 
        'male_manganese', 
    ];

    public const FEMALE_FIELDS = [
        'female_weight_in_kg', 
        'female_calcium', 
        'female_iron', 
        'female_iodine', 
        'female_magnesium', 
        'female_phosphorus', 
        'female_zinc', 
        'female_selenium', 
        'female_fluoride', 
        'female_manganese', 
    ];
}
