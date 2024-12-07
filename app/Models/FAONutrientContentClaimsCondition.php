<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAONutrientContentClaimsCondition extends Model
{
    use HasFactory;

    public $table = 'fao_nutrient_content_claims_conditions';

    protected $fillable = [
        'component',
        'claim',
        'food_state',
        'condition',
        'condition_type',
      
        'additional_condition_id',
    ];
}
