<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodNutrient;
use App\Models\FoodType;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Food::query()->with('nutrients');

        if ($request->description) {
            $query
                ->where(function($query) use ($request) {
                    $query
                        ->orWhere('description', 'LIKE', '%' . $request->description . '%')
                        ->orWhere('alternate_names', 'LIKE', '%' . $request->description . '%')
                        ->orWhere('scientific_name', 'LIKE', '%' . $request->description . '%')
                        ->orWhere('brand', 'LIKE', '%' . $request->description . '%');
                });
        } 

        if ($request->has('category')) {
            $category_id = FoodType::where('slug', $request->category)->value('id');
           
            $query->where('food_type', $category_id)
                    ->orWhere('food_subtype', $category_id);
        }

        if ($request->calories) {
            $calories_data = $this->splitQueryParams($request->calories);

            if (count($calories_data) > 2) {
                $order_by = $this->getOrderBy($calories_data['operator']);
                $query
                    ->where('calories', $calories_data['operator'], $calories_data['amount'])
                    ->where('calories_unit', '=', $calories_data['unit'])
                    ->orderBy('calories', $order_by); 
            }
        }


        if ($request->carbohydrates) {

            $carbs_data = $this->splitQueryParams($request->carbohydrates);

            if (count($carbs_data) > 2) {
                $order_by = $this->getOrderBy($carbs_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'total carbohydrates')
                    ->where('food_nutrients.normalized_amount', $carbs_data['operator'], $carbs_data['amount'])
                    ->where('food_nutrients.unit', '=', $carbs_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->fat) {
           
            $fats_data = $this->splitQueryParams($request->fat);
            
            if (count($fats_data) > 2) {

                $order_by = $this->getOrderBy($fats_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'total fat')
                    ->where('food_nutrients.normalized_amount', $fats_data['operator'], $fats_data['amount'])
                    ->where('food_nutrients.unit', '=', $fats_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            } 
        }
        

       
        if ($request->protein) {
            
            $protein_data = $this->splitQueryParams($request->protein);
            
            if (count($protein_data) > 2) {
                $order_by = $this->getOrderBy($protein_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'protein')
                    ->where('food_nutrients.normalized_amount', $protein_data['operator'], $protein_data['amount'])
                    ->where('food_nutrients.unit', '=', $protein_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->sodium) {

            $sodium_data = $this->splitQueryParams($request->sodium);
            
            if (count($sodium_data) > 2) {
                $order_by = $this->getOrderBy($sodium_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'sodium')
                    ->where('food_nutrients.normalized_amount', $sodium_data['operator'], $sodium_data['amount'])
                    ->where('food_nutrients.unit', '=', $sodium_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->fiber) {

            $fiber_data = $this->splitQueryParams($request->fiber);
            
            if (count($fiber_data) > 2) {
                $order_by = $this->getOrderBy($fiber_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'dietary fiber')
                    ->where('food_nutrients.normalized_amount', $fiber_data['operator'], $fiber_data['amount'])
                    ->where('food_nutrients.unit', '=', $fiber_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->sugar) {

            $sugar_data = $this->splitQueryParams($request->sugar);
            
            if (count($sugar_data) > 2) {
                $order_by = $this->getOrderBy($sugar_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'sugar')
                    ->where('food_nutrients.normalized_amount', $sugar_data['operator'], $sugar_data['amount'])
                    ->where('food_nutrients.unit', '=', $sugar_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->cholesterol) {

            $cholesterol_data = $this->splitQueryParams($request->cholesterol);
            
            if (count($cholesterol_data) > 2) {
                $order_by = $this->getOrderBy($cholesterol_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'cholesterol')
                    ->where('food_nutrients.normalized_amount', $cholesterol_data['operator'], $cholesterol_data['amount'])
                    ->where('food_nutrients.unit', '=', $cholesterol_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }

        }


        if ($request->calcium) {
            
            $calcium_data = $this->splitQueryParams($request->calcium);
            
            if (count($calcium_data) > 2) {
                $order_by = $this->getOrderBy($calcium_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'calcium')
                    ->where('food_nutrients.normalized_amount', $calcium_data['operator'], $calcium_data['amount'])
                    ->where('food_nutrients.unit', '=', $calcium_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }

        }


        if ($request->vitamin_c) {
            
            $vitamin_c_data = $this->splitQueryParams($request->vitamin_c);
            
            if (count($vitamin_c_data) > 2) {
                $order_by = $this->getOrderBy($vitamin_c_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'vitamin c')
                    ->where('food_nutrients.normalized_amount', $vitamin_c_data['operator'], $vitamin_c_data['amount'])
                    ->where('food_nutrients.unit', '=', $vitamin_c_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }

        }


        if ($request->vitamin_a) {
            
            $vitamin_a_data = $this->splitQueryParams($request->vitamin_a);
            
            if (count($vitamin_a_data) > 2) {
                $order_by = $this->getOrderBy($vitamin_a_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'vitamin a')
                    ->where('food_nutrients.normalized_amount', $vitamin_a_data['operator'], $vitamin_a_data['amount'])
                    ->where('food_nutrients.unit', '=', $vitamin_a_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }

        }




        if ($request->iron) {
            
            $iron_data = $this->splitQueryParams($request->iron);
            
            if (count($iron_data) > 2) {
                $order_by = $this->getOrderBy($iron_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'iron')
                    ->where('food_nutrients.normalized_amount', $iron_data['operator'], $iron_data['amount'])
                    ->where('food_nutrients.unit', '=', $iron_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }

        }



        if ($request->potassium) {
            $potassium_data = $this->splitQueryParams($request->potassium);
            
            if (count($potassium_data) > 2) {
                $order_by = $this->getOrderBy($potassium_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'potassium')
                    ->where('food_nutrients.normalized_amount', $potassium_data['operator'], $potassium_data['amount'])
                    ->where('food_nutrients.unit', '=', $potassium_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->magnesium) {
            $magnesium_data = $this->splitQueryParams($request->magnesium);
            
            if (count($magnesium_data) > 2) {
                $order_by = $this->getOrderBy($magnesium_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'magnesium')
                    ->where('food_nutrients.normalized_amount', $magnesium_data['operator'], $magnesium_data['amount'])
                    ->where('food_nutrients.unit', '=', $magnesium_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->vitamin_b1) {
            $vitamin_b1_data = $this->splitQueryParams($request->vitamin_b1);
            
            if (count($vitamin_b1_data) > 2) {
                $order_by = $this->getOrderBy($vitamin_b1_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'vitamin b1')
                    ->where('food_nutrients.normalized_amount', $vitamin_b1_data['operator'], $vitamin_b1_data['amount'])
                    ->where('food_nutrients.unit', '=', $vitamin_b1_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->vitamin_b2) {
            $vitamin_b2_data = $this->splitQueryParams($request->vitamin_b2);
            
            if (count($vitamin_b2_data) > 2) {
                $order_by = $this->getOrderBy($vitamin_b2_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'vitamin b2')
                    ->where('food_nutrients.normalized_amount', $vitamin_b2_data['operator'], $vitamin_b2_data['amount'])
                    ->where('food_nutrients.unit', '=', $vitamin_b2_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        if ($request->vitamin_b3) {
            $vitamin_b3_data = $this->splitQueryParams($request->vitamin_b3);
            
            if (count($vitamin_b3_data) > 2) {
                $order_by = $this->getOrderBy($vitamin_b3_data['operator']);

                $query->join('food_nutrients', 'food_nutrients.food_id', '=', 'foods.id')
                    ->where('food_nutrients.name', '=', 'vitamin b3')
                    ->where('food_nutrients.normalized_amount', $vitamin_b3_data['operator'], $vitamin_b3_data['amount'])
                    ->where('food_nutrients.unit', '=', $vitamin_b3_data['unit'])
                    ->orderBy('food_nutrients.normalized_amount', $order_by)
                    ->select('foods.id', 'foods.description', 'foods.description_slug', 'foods.title_image', 'foods.calories', 'foods.calories_unit', 'food_nutrients.food_id', 'food_nutrients.name', 'food_nutrients.amount', 'food_nutrients.unit');
            }
        }


        $result = $query->paginate(10);
        return $result;
    }


    private function getOrderBy($operator)
    {
        // order depends on the operator. if >=, > then show higher to lower. if <=, < then show lowest to highest
        if (strpos($operator, '>') !== false) {
            return 'ASC';
        } else if (strpos($operator, '<') !== false) {
            return 'DESC';
        }
        return 'ASC';
    }


    private function splitQueryParams($query_param)
    {
        preg_match('/^([^\d]+)?(\d+(\.\d+)?)([^\d]+)?$/', $query_param, $results);
       
        $operator = '=';
        if ($results[1] === 'lte') {
            $operator = '<=';
        } else if ($results[1] === 'gte') {
            $operator = '>=';
        } else if ($results[1] === 'lt') {
            $operator = '<';
        } else if ($results[1] === 'gt') {
            $operator = '>';
        }

        $d = [
            'amount' => $results[2],
            'unit' => $results[4], 
            'operator' => $operator,
        ];
        info($d);
        return $d;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $food_data = $request->all();
        // return $food_data;

        $new_food = Food::create($food_data);
      
        $nutrients = json_decode($food_data['nutrients'], true);

        $food_nutrients = [];

        foreach ($nutrients as $food_n) {
            $food_nutrient = FoodNutrient::create([
                'food_id' => $new_food->id,
                'name' => $food_n['name'],
                'amount' => $food_n['amount'],
                'unit' => $food_n['unit'],   
            ]);

            if (isset($food_n['composition'])) {
                foreach ($food_n['composition'] as $food_n_composition) {

                    $food_nutrients[] = FoodNutrient::create([
                        'food_id' => $new_food->id,
                        'parent_nutrient_id' => $food_nutrient->id,
                        'name' => $food_n_composition['name'],
                        'amount' => $food_n_composition['amount'],
                        'unit' => $food_n_composition['unit'],   
                    ]);
                }
            }
        }

        return [
            'food' => $new_food,
            'nutrients' => $food_nutrients,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        $food->load('nutrients', 'type', 'subtype', 'state', 'substate', 'customServingsCategory.servingUnits');

        $breadcrumbs = [];
        if ($food->type) {
            $breadcrumbs = [$food->type->name];
            if ($food->subtype) {
                $breadcrumbs[] = $food->subtype->name;
            }
        }

        $food->breadcrumbs = $breadcrumbs;

        $food->hasIngredientsInfo = false;
        if ($food->ingredientsInfo()->exists()) {
            $food->hasIngredientsInfo = true;
        }

        if ($food->target_age_group) {
            $food->age = Food::TARGET_AGE_GROUPS[$food->target_age_group];
        }
        
        return $food;
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {   
        $data = $request->all();

        return $data;
        
        $food->update($data);

        if (isset($data['nutrients'])) {
            
            $food_nutrients = FoodNutrient::where('food_id', $food->id)->get();
            $updated_nutrients = collect(json_decode($data['nutrients'], true));
    
            foreach ($food_nutrients as $nutrient) {
                if ($updated_nutrient = $updated_nutrients->firstWhere('name', $nutrient->name)) {
                    FoodNutrient::where('id', $nutrient->id)
                        ->update([
                            'amount' => $updated_nutrient['amount'],
                            'unit' => $updated_nutrient['unit'],
                        ]);
                }
            }
        }

        $food->load('nutrients');
        return $food;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete(); 
        FoodNutrient::where('food_id', $food->id)->delete();

        return 'deleted';
    }
}
