<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDRIMacronutrientDistribution extends Model
{
    use HasFactory;

    public $table = 'pdri_macronutrient_distribution';

    protected $fillable = [
        'age_from',
        'age_to',
        'age_type',

        'protein_from',
        'protein_to',

        'fat_from',
        'fat_to',

        'carbs_from',
        'carbs_to'
    ];

    protected $visible = [
        'age_from',
        'age_to',
        'age_type',

        'protein_from',
        'protein_to',

        'fat_from',
        'fat_to',

        'carbs_from',
        'carbs_to'
    ];
}
