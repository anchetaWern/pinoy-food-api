<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FoodNutrient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use App\Models\FoodBarcode;
use App\Models\FoodType;
use App\Models\Ingredient;
use App\Models\FoodIngredient;
use App\Models\CustomServingsCategory;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'foods';

    protected $fillable = [
        'description', 
        'description_slug',
        'scientific_name',
        'alternate_names',
        'summary', // ai summary
        'brand',
        'food_type',
        'food_subtype',
        'food_state',
        'food_substate',

        'food_density_id',

        'custom_id',
        'calories',
        'calories_unit',
        'serving_size',
        'serving_size_unit',
        'custom_serving_size',
        'servings_per_container',
      
        'edible_portion',
        'title_image',
        'nutrition_label_image',
        'ingredients_image',
        'ingredients',
        'allergen_information',
        'barcode_image',
        'daily_values_reference',
        'target_age_group',
        'origin_country',
    ];

    protected $casts = [
        'nutrients' => 'array',
    ];

    protected $hidden = [
        'id',
        'deleted_at',
    ];

    public const DAILY_VALUES_REF = [
        'reni_2002',
        'pdri_2015',
    ];

    public const DEFAULT_DAILY_VALUES_REF = 'reni_2002';

    public const TARGET_AGE_GROUPS = [
        'infants' => [0, 12, 'month'],
        'toddlers' => [1, 3, 'year'],
        'preschooler' => [4, 5, 'year'],
        'children' => [6, 12, 'year'],
        'adolescents' => [13, 18, 'year'],
        'young adults' => [19, 30, 'year'],
        'adults' => [31, 50, 'year'],
        'middle aged adults' => [51, 64, 'year'],
        'seniors' => [65, null, 'year'],
    ];

    public const DEFAULT_AGE_GROUP = 'young adults';

    public const FOOD_TYPES = [
        'cereals and grains' => 1,
        'vegetables' => 2,
        'fruits' => 3,
        'meat and poultry' => 4,
        'fish and seafood' => 5,
        'dairy products' => 6,
        'legumes, nuts, and seeds' => 7,
        'fats and oils' => 8,
        'sugars and sweets' => 9,
        'beverages' => 10,
        'herbs and spices' => 11,
        'prepared and processed' => 12,
    ];


    public const CATEGORY_SLUGS = [
        'vegetables' => 1,
        'meat-and-poultry' => 8,
        'legumes-nuts-and-seeds' => 13,
        'fats-and-oils' => 19,
        'fruits' => 24,
        'cereals-and-grains' => 30,
        'dairy-products' => 34,
        'herbs-and-spices' => 40,
        'beverages' => 45,
        'prepared-and-processed' => 57,
        'sugars-and-sweets' => 78,
        'foraged-foods' => 84,
    ];

    public const DEFAULT_FOOD_TYPE = 12;


    protected static function boot() {
        parent::boot();
    
        static::creating(function ($food) {
            $food->description_slug = Str::slug($food->description);
        });
    }

    public function getRouteKeyName()
    {
        return 'description_slug';
    }

    public function nutrients()
    {
        return $this->hasMany(FoodNutrient::class, 'food_id');
    }


    public function type()
    {
        return $this->hasOne(FoodType::class, 'id', 'food_type');
    }


    public function subtype()
    {
        return $this->hasOne(FoodType::class, 'id', 'food_subtype');
    }


    public function state()
    {
        return $this->hasOne(FoodState::class, 'id', 'food_state');
    }


    public function subState()
    {
        return $this->hasOne(FoodState::class, 'id', 'food_substate');
    }

    public function ingredientsInfo()
    {
        return $this->hasManyThrough(
            Ingredient::class,
            FoodIngredient::class,
            'food_id', 
            'id', 
        );
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
                            $sub_nutrient_data = [
                                'name' => $sub_nutrient['name'],
                                'amount' => $sub_nutrient['amount'],
                                'unit' => $sub_nutrient['unit'],
                            ];

                            $sub_sub_nutrients = $nutrient_collection->where('parent_nutrient_id', $sub_nutrient['id']);

                            if ($sub_sub_nutrients) {
                                foreach ($sub_sub_nutrients as $sub_sub_nutrient) {

                                    $sub_nutrient_data['composition'][] = [
                                        'name' => $sub_sub_nutrient['name'],
                                        'amount' => $sub_sub_nutrient['amount'],
                                        'unit' => $sub_sub_nutrient['unit'],
                                    ];

                                }
                            }

                            $nutrient_data['composition'][] = $sub_nutrient_data;
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

    public function barcode()
    {
        return $this->hasOne(FoodBarcode::class);
    }


    public function customServingsCategory()
    {
        return $this->hasOne(CustomServingsCategory::class, 'id', 'custom_servings_category_id');
    }
}
