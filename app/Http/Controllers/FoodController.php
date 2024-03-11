<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateCreateFoodRequest;
use App\Http\Requests\ValidateUpdateFoodRequest;
use App\Models\Food;
use App\Models\FoodNutrient;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Food::query()->with('nutrients');

      
        if ($request->description) {
            $query->where('description', 'LIKE', '%' . $request->description . '%');
        } 

        if ($request->calories) {
            $calories_data = $this->splitQueryParams($request->calories);

            if (count($calories_data) > 2) {
                $query
                    ->where('calories', $calories_data['operator'], $calories_data['amount'])
                    ->where('calories_unit', '=', $calories_data['unit']);
            }
        }


        if ($request->carbs) {

            $carbs_data = $this->splitQueryParams($request->carbs);

            if (count($carbs_data) > 2) {
                $query
                    ->whereHas('nutrients', function ($query) use ($carbs_data) {

                        $query
                            ->where('name', '=', 'Carbohydrates')
                            ->where('amount', $carbs_data['operator'], $carbs_data['amount'])
                            ->where('unit', '=', $carbs_data['unit']);
                    });
            }
        }


        if ($request->fat) {
           
            $fats_data = $this->splitQueryParams($request->fat);
            
            if (count($fats_data) > 2) {
                $query
                    ->whereHas('nutrients', function ($query) use ($fats_data) {
                        $query
                            ->where('name', '=', 'Fat')
                            ->where('amount', $fats_data['operator'], $fats_data['amount'])
                            ->where('unit', '=', $fats_data['unit']);
                          
                    });
            } 
        }
        

       
        if ($request->protein) {
            
            $protein_data = $this->splitQueryParams($request->protein);
            
            if (count($protein_data) > 2) {
                $query
                    ->whereHas('nutrients', function ($innerQuery) use ($protein_data) {
                        
                        $innerQuery
                            ->where('name', '=', 'Protein')
                            ->where('amount', $protein_data['operator'], $protein_data['amount'])
                            ->where('unit', '=', $protein_data['unit']);
                    });
            }
        }

        $result = $query->get();
        return $result;
    }


    private function splitQueryParams($query_param)
    {
        preg_match('/^([^\d]+)?(\d+)([^\d]+)?$/', $query_param, $results);
       
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

        return [
            'amount' => $results[2],
            'unit' => $results[3], // substr($results[2], 0, -1),
            'operator' => $operator,
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateCreateFoodRequest $request)
    {
        $food_data = $request->validated();

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
        $food->load('nutrients');
        return $food;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateUpdateFoodRequest $request, Food $food)
    {   
        $data = $request->validated();
        
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
