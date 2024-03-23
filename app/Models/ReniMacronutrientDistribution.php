<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReniMacronutrientDistribution extends Model
{
    use HasFactory;

    public $table = 'reni_macronutrient_distribution';

    protected $fillable = [
        'age_from',
        'age_to',

        'protein_from',
        'protein_to',

        'fat_from',
        'fat_to',

        'carbs_from',
        'carbs_to'
    ];
}
