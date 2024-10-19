<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDRIEnergyIntake extends Model
{
    use HasFactory;

    public $table = 'pdri_energy_intake';

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

    public const MALE_FIELDS = [
        'male_weight_in_kg',
        'male_energy_req_in_kcal',
    ];

    public const FEMALE_FIELDS = [
        'female_weight_in_kg',
        'female_energy_req_in_kcal',
    ];

    public const UNGENDERED_FIELDS = [
        'age_from',
        'age_to',
        'age_type',
    ];

}
