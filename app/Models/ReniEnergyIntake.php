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
        'male_weight',
        'female_weight',
        'male_energy_req_in_kcal',
        'female_energy_req_in_kcal',
    ];
}
