<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FoodNutrient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'foods';

    protected $fillable = [
        'description', 
        'calories',
        'calories_unit',
        'serving_size',
        'serving_size_unit',
        'servings_per_container',
        'title_image',
        'nutrition_label_image',
        'ingredients_image',
        'ingredients',
        'barcode_image'
    ];

    protected $casts = [
        'nutrients' => 'array',
    ];


    public function nutrients()
    {
        return $this->hasMany(FoodNutrient::class);
    }


    public function toArray()
    {
        $array = parent::toArray();

        if (isset($array['nutrients'])) {
            
            $formattedNutrients = [];
            $nutrient_collection = collect($array['nutrients']);
            
            foreach ($array['nutrients'] as $nutrient) {
                if (is_null($nutrient['parent_nutrient_id'])) {
                    $nutrient_data = [
                        'name' => $nutrient['name'],
                        'amount' => $nutrient['amount'],
                        'unit' => $nutrient['unit'],
                    ];

                    $sub_nutrients = $nutrient_collection->where('parent_nutrient_id', $nutrient['id']);
                    if ($sub_nutrients) {
                        foreach ($sub_nutrients as $sub_nutrient) {
                            $nutrient_data['composition'][] = [
                                'name' => $sub_nutrient['name'],
                                'amount' => $sub_nutrient['amount'],
                                'unit' => $sub_nutrient['unit'],
                            ];
                        }
                        
                    }

                    $formattedNutrients[] = $nutrient_data;
                }     
            }

            $array['nutrients'] = $formattedNutrients;
        }

        return $array;
    }

    protected function generateUrlFromStorage($value)
    {
        $baseUrl = config('app.url');

        // Check if $value is null
        if ($value === null) {
            return null; // or return a default value if preferred
        }

        return $baseUrl . Storage::url($value);
    }


    protected function titleImage(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->generateUrlFromStorage($value);
            }
        );
    }

    
    protected function nutritionLabelImage(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->generateUrlFromStorage($value);
            }
        );
    }

    protected function barcodeImage(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->generateUrlFromStorage($value);
            }
        );
    }

    protected function ingredientsImage(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->generateUrlFromStorage($value);
            }
        );
    }
    
}
