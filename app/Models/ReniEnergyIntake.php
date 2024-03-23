<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniEnergyIntake extends Model
{
    use HasFactory;

    public $table = 'reni_energy_intake';

    protected $fillable = [
        'age_from',
        'age_to',
        'age_type',
        'male_weight_in_kg',
        'female_weight_in_kg',
        'male_energy_req_in_kcal',
        'female_energy_req_in_kcal',
    ];

    protected $visible = [
        'age_from',
        'age_to',
        'age_type',
        'male_weight_in_kg',
        'female_weight_in_kg',
        'male_energy_req_in_kcal',
        'female_energy_req_in_kcal',
    ];

}
