<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Str;
use App\Models\Food;
use App\Models\FoodNutrient;
use Illuminate\Support\Facades\Storage;

class AddFoodUsingJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:food_json {file} {brand}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add food data using json on the specified location';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('file');
        $brand = $this->argument('brand');
       
        $contents = Storage::get('data/restaurants/jollibee/' . $filename);
        $food_data = json_decode($contents, true);

        foreach ($food_data as $row) {

            $calories_data = getValueAndUnit($row['calories']);
            $serving_size_data = getValueAndUnit($row['serving_size']);

            $food = Food::create([
                'description' => $row['food'], 
               
                'description_slug' => Str::slug($row['food']),
                'brand' => $brand,
                'food_type' => 57,
                'food_subtype' => 75,
                'calories' => $calories_data['value'],
                'calories_unit' => $calories_data['unit'], 
                'serving_size' => $serving_size_data['value'],
                'serving_size_unit' => $serving_size_data['unit'], 
                'servings_per_container' => 1,
                'custom_serving_size' => isset($row['custom_serving_size']) ? $row['custom_serving_size'] : null,
               
                'country' => 'PH',
            ]);

            $this->saveFoodNutrientsJson($food, $row['nutrients']);


        }
        
    }


    private function saveFoodNutrientsJson($food, $nutrients)
    {

        foreach ($nutrients as $nut) {

            $nutrient_data = getValueAndUnit($nut['value']);
    
            $created_nutrient = FoodNutrient::create([
                'food_id' => $food->id,
                'parent_nutrient_id' => null,
                'name' => $nut['name'],
                'amount' => $nutrient_data['value'],
                'unit' => $nutrient_data['unit'],
                'normalized_amount' => normalizeNutrientValue($nutrient_data['value'], $food->serving_size),
            ]);
            
            if (isset($nut['child'])) {
    
                $child_nuts = $nut['child'];
                foreach ($child_nuts as $c_nut) {
    
                    $child_nutrient_data = getValueAndUnit($c_nut['value']);
    
                    $created_child_nutrient = FoodNutrient::create([
                        'food_id' => $food->id,
                        'parent_nutrient_id' => $created_nutrient->id,
                        'name' => $c_nut['name'],
                        'amount' => $child_nutrient_data['value'],
                        'unit' => $child_nutrient_data['unit'],
                        'normalized_amount' => normalizeNutrientValue($child_nutrient_data['value'], $food->serving_size),
                    ]);
    
                    if (isset($c_nut['child'])) {
    
                        $grandchild_nuts = $c_nut['child'];
    
                        foreach ($grandchild_nuts as $gc_nut) {
    
                            $grandchild_nutrient_data = getValueAndUnit($gc_nut['value']);
    
                            $created_grandchild_nutrient = FoodNutrient::create([
                                'food_id' => $food->id,
                                'parent_nutrient_id' => $created_child_nutrient->id,
                                'name' => $gc_nut['name'],
                                'amount' => $grandchild_nutrient_data['value'],
                                'unit' => $grandchild_nutrient_data['unit'],
                                'normalized_amount' => normalizeNutrientValue($grandchild_nutrient_data['value'], $food->serving_size),
                            ]);
                        }
                    }
    
                }
            }
        }
    }
}
