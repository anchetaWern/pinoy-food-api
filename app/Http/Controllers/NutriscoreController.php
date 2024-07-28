<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\NutriscorePoint;

class NutriscoreController extends Controller
{
    public function __invoke(Food $food)
    {
        return $this->getNutriscore($food);
    }

    private function getNutriscore($food)
    {
        $total_negative = 0;
        $total_positive = 0;

        // energy points
        $nutrient_multiplier = 1;
        $serving_size_basis = 100;

        $liquid_food_state_id = 2;

        $negative_nutrients = [
            'saturated fat',
            'sodium',
            'sugar',
        ];
    
        $positive_nutrients = [
            'protein',
            'dietary fiber',
        ];


        if ($food->serving_size < $serving_size_basis) {
            $nutrient_multiplier = $serving_size_basis / $food->serving_size;
        }

        $energy_points_basis = $food->calories * $nutrient_multiplier;


        if ($food->food_state == $liquid_food_state_id) {
       
            $energy_points = NutriscorePoint::where('nutriscore_category_id', 1)
                ->where('food_type', 'beverage')
                ->where('min_value', '<=', $energy_points_basis)
                ->where(function ($query) use ($energy_points_basis) {
                    $query->orWhere('max_value', '>=', $energy_points_basis)
                        ->orWhereNull('max_value');
                })->value('points');
        } else {
            $energy_points = NutriscorePoint::where('nutriscore_category_id', 1)
                ->where('food_type', 'unspecified')
                ->where('min_value', '<=', $energy_points_basis)
                ->where(function ($query) use ($energy_points_basis) {
                    $query->orWhere('max_value', '>=', $energy_points_basis)
                        ->orWhereNull('max_value');
                })
                ->value('points');     
        }

        $total_negative += $energy_points;


        // fruits & vegetable points

        $fruit_veggie_legume_nuts_seed_points = 0;

        $vegetables_food_type_id = 1;
        $fruits_food_type_id = 24;
        $nuts_legumes_seeds_id = 13;

        if ($food->food_type == $vegetables_food_type_id || $food->food_type == $fruits_food_type_id || $food->food_type == $nuts_legumes_seeds_id) { // fruits, veggies, nuts & legumes
            // note: not yet possible to add fruits or veggie points if the food is not a wholefood
            // as this requires the exact ingredients. it can only be estimated.
            /* 
            - First Ingredient: If fruits, vegetables, or nuts are listed first, they likely make up a significant portion, potentially 50% or more of the product.
            - First Few Ingredients: If they are among the first few ingredients but not the first, they might constitute around 20-40% of the product.
            - Middle of the List: If they appear in the middle of the list, the percentage could be around 10-20%.
            - Towards the End: If they are towards the end, they are likely less than 10%.
            */
            $weight_by_percentage = 100;
            $fruit_veggie_legume_nuts_seed_points = NutriscorePoint::where('nutriscore_category_id', 5)
                ->where('min_value', '<=', $weight_by_percentage)
                ->where(function ($query) use ($weight_by_percentage) {
                    $query->orWhere('max_value', '>=', $weight_by_percentage)
                        ->orWhereNull('max_value');
                })
                ->value('points');
            
            $total_positive += $fruit_veggie_legume_nuts_seed_points;
        }
        
        
        $nutriscore_nutrient_to_category_mapping = [
            'protein' => 7,
            'dietary fiber' => 6,
            'sodium' => 4,
            'saturated fat' => 3,
            'sugar' => 2,
        ];
        
        $fats_and_oils_food_type_id = 19; 
        $is_cooking_fat = $food->food_type == $fats_and_oils_food_type_id;

        $fiber_points = 0;
        $protein_points = 0;

        $sugar_points = 0;
        $saturated_fat_points = 0;
        $sodium_points = 0;
        
        foreach ($food->nutriscoreNutrients as $row) {
    
            $nutriscore_category_id = $nutriscore_nutrient_to_category_mapping[$row->name];
    
            $serving_adjusted_amount = $row->amount * $nutrient_multiplier;
    
            if (in_array($row->name, $positive_nutrients)) {
    
                // protein and dietary fiber
                $positive_row_point = NutriscorePoint::where('nutriscore_category_id', $nutriscore_category_id)
                            ->where('food_type', 'unspecified')
                            ->where('min_value', '<=', $serving_adjusted_amount)
                            ->where(function ($query) use ($serving_adjusted_amount) {
                                $query->orWhere('max_value', '>=', $serving_adjusted_amount)
                                    ->orWhereNull('max_value');
                            })
                            ->value('points');    
    
                if ($row->name == 'protein') {
                    $protein_points = $positive_row_point;
                } else if ($row->name == 'dietary fiber') {
                    $fiber_points = $positive_row_point;
                }

                $total_positive += $positive_row_point;       
    
            } else if (in_array($row->name, $negative_nutrients)) {
    
                $negative_row_point = 0;
    
                if ($row->name == 'sugar') {

                    // can be beverage or unspecified
                    if ($food->food_state == $liquid_food_state_id) {
                        $negative_row_point = NutriscorePoint::where('nutriscore_category_id', $nutriscore_category_id)
                            ->where('food_type', 'beverage')
                            ->where('min_value', '<=', $serving_adjusted_amount)
                            ->where(function ($query) use ($serving_adjusted_amount) {
                                $query->orWhere('max_value', '>=', $serving_adjusted_amount)
                                    ->orWhereNull('max_value');
                            })
                            ->value('points');
                    } else {
                        $negative_row_point = NutriscorePoint::where('nutriscore_category_id', $nutriscore_category_id)
                            ->where('food_type', 'unspecified')
                            ->where('min_value', '<=', $serving_adjusted_amount)
                            ->where(function ($query) use ($serving_adjusted_amount) {
                                $query->orWhere('max_value', '>=', $serving_adjusted_amount)
                                    ->orWhereNull('max_value');
                            })
                            ->value('points');
                    }

                    $sugar_points = floor($negative_row_point);
    
                } else if ($row->name == 'saturated fat' || $row->name == 'sodium') {
                    // can be non-cooking fat or unspecified
                    if ($is_cooking_fat) {
                        $negative_row_point = NutriscorePoint::where('nutriscore_category_id', $nutriscore_category_id)
                            ->where('food_type', 'cooking_fat')
                            ->where('min_value', '<=', $serving_adjusted_amount)
                            ->where(function ($query) use ($serving_adjusted_amount) {
                                $query->orWhere('max_value', '>=', $serving_adjusted_amount)
                                    ->orWhereNull('max_value');
                            })
                            ->value('points');
                    } else {
                        $negative_row_point = NutriscorePoint::where('nutriscore_category_id', $nutriscore_category_id)
                            ->where('food_type', 'unspecified')
                            ->where('min_value', '<=', $serving_adjusted_amount)
                            ->where(function ($query) use ($serving_adjusted_amount) {
                                $query->orWhere('max_value', '>=', $serving_adjusted_amount)
                                    ->orWhereNull('max_value');
                            })
                            ->value('points');
                    }

                    if ($row->name == 'saturated fat') {
                        $saturated_fat_points = $negative_row_point;
                    } else if ($row->name == 'sodium') {
                        $sodium_points = $negative_row_point;
                    }
                } 
    
                $total_negative += $negative_row_point;
    
            }
        }
    
        $points = $total_negative - $total_positive;
    
        $grade = null;
        if ($points <= -1 && $points >= -15) {
            $grade = 'A';
        } else if ($points >= 0 && $points <= 2) {
            $grade = 'B';
        } else if ($points >=3 && $points <= 10) {
            $grade = 'C';
        } else if ($points >= 11 && $points <= 18) {
            $grade = 'D';
        } else if ($points >= 19 && $points <= 40) {
            $grade = 'E';
        }

        return [
            'total_negative' => $total_negative,
            'total_positive' => $total_positive,
            'points' => $points,
            'grade' => $grade,
            'details' => [
                'negative_points' => [
                    'energy' => $energy_points,
                    'simple_sugars' => $sugar_points,
                    'saturated_fats' => $saturated_fat_points,
                    'salt' => $sodium_points,
                ],
                'positive_points' => [
                    'fruits_vegetables_nuts_legumes' => $fruit_veggie_legume_nuts_seed_points,
                    'fiber' => $fiber_points,
                    'protein' => $protein_points,
                ]
            ],
        ];

    }
}
