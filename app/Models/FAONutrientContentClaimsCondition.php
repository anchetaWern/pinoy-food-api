<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FAONutrientReferenceValue;
use App\Models\FAONutrientConditionsReferenceValue;

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

    protected $visible = [
        'id',
        'component',
        'claim',
        'food_state',
        'condition',
        'condition_type',
      
        'additional_condition_id',
        'referenceValues',
    ];


    public function referenceValues()
    {
        return $this->hasManyThrough(
            FAONutrientReferenceValue::class, 
            FAONutrientConditionsReferenceValue::class, 

            'claim_id',
            'id', 
            'id',
            'reference_id' 
        );
    }
}
