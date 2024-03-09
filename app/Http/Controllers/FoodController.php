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
            preg_match('/^(\d+)([^\d]+)$/', $request->calories, $calories_data);
            
            $query
                ->where('calories', '<=', $calories_data[1])
                ->where('calories_unit', '=', $calories_data[2]);
        }

        $result = $query->get();
        return $result;
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
