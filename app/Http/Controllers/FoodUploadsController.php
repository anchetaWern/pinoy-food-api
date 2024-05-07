<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodUpload;
use App\Models\Food;
use App\Models\Nutrient;
use App\Models\FoodNutrient;
use App\Models\FoodBarcode;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ValidateFoodUploadRequest;
use Str;

class FoodUploadsController extends Controller
{
    public function index()
    {
        $food_upload = FoodUpload::orderBy('created_at', 'ASC')->first();
        $nutrients = Nutrient::whereNull('parent_id')->get();

        $excluded_top_level = ['Vitamins', 'Minerals', 'Others'];

        return view('food-uploads', [
            'food_upload' => $food_upload,
            'nutrients' => $nutrients,
            'excluded_top_level' => $excluded_top_level,
        ]);
    }


    public function store(ValidateFoodUploadRequest $request)
    {
        $data = $request->except(['id', '_token']);
      
        $nutrients_data = $request->except(['id', '_token', 'description', 'barcode', 'ingredients', 'serving_size', 'servings_per_container', 'calories']);
        

        $calories_and_unit = $this->getValueAndUnit($data['calories']);
        $serving_size_and_unit = $this->getValueAndUnit($data['serving_size']);

        $id = request('id');
        $food_upload = FoodUpload::find($id);
        

        $food = Food::create([
            'description' => $data['description'], 
            'description_slug' => Str::slug($data['description']),
            'calories' => $calories_and_unit['value'],
            'calories_unit' => $calories_and_unit['unit'], 
            'serving_size' => $serving_size_and_unit['value'],
            'serving_size_unit' => $serving_size_and_unit['unit'], 
            'servings_per_container' => $data['servings_per_container'],

            'title_image' => $food_upload->title_image,
            'nutrition_label_image' => $food_upload->nutrition_label_image,
            'barcode_image' => $food_upload->barcode_image,
            
            'ingredients' => $data['ingredients'],
            'ingredients_image' => $food_upload->ingredients_image,
        ]);

        if ($request->has('barcode') && $request->input('barcode') != null) {
          
            FoodBarcode::create([
                'food_id' => $food->id,
                'barcode' => request('barcode'), 
            ]);
            
        }

        $roots = [];
        $trunks = [];
        $branches = [];
        
        foreach ($nutrients_data as $root_key => $root_row) {

            if (is_array($root_row)) {

                foreach ($root_row as $parent_key => $parent_row) {
                    if (is_array($parent_row)) {
                        foreach ($parent_row as $child_key => $child_row) {
                           
                            if ($child_row) {

                                $branch_nutrient_and_unit = $this->getValueAndUnit($child_row);

                                $trunk_nutrient_id = isset($trunks[strtolower($parent_key)]) ? $trunks[strtolower($parent_key)] : null;

                                FoodNutrient::create([
                                    'food_id' => $food->id,
                                    'parent_nutrient_id' => $trunk_nutrient_id,
                                    'name' => str_replace('_', ' ', strtolower($child_key)),
                                    'amount' => $branch_nutrient_and_unit['value'],
                                    'unit' => $branch_nutrient_and_unit['unit'],   
                                ]);
                            }

                        }
                    } else {
                       
                        if ($parent_row) {

                            $trunk_nutrient_and_unit = $this->getValueAndUnit($parent_row);

                            $root_nutrient_id = isset($roots[strtolower($root_key)]) ? $roots[strtolower($root_key)] : null;

                            $trunk_nutrient = FoodNutrient::create([
                                'food_id' => $food->id,
                                'parent_nutrient_id' => $root_nutrient_id,
                                'name' => str_replace('_', ' ', strtolower($parent_key)),
                                'amount' => $trunk_nutrient_and_unit['value'],
                                'unit' => $trunk_nutrient_and_unit['unit'],   
                            ]);

                            $trunks[strtolower($parent_key)] = $trunk_nutrient->id;

                        }
                    }
                } 
            } else {
                
                if ($root_row) {

                    $root_nutrient_and_unit = $this->getValueAndUnit($root_row);
                    
                    $root_nutrient = FoodNutrient::create([
                        'food_id' => $food->id,
                        'parent_nutrient_id' => null,
                        'name' => str_replace('_', ' ', strtolower($root_key)),
                        'amount' => $root_nutrient_and_unit['value'],
                        'unit' => $root_nutrient_and_unit['unit'],   
                    ]);

                    $roots[strtolower($root_key)] = $root_nutrient->id; 
                }
            }
        }


        $food_upload->delete();

        return back()
            ->with('alert', ['type' => 'success', 'text' => 'Successfully added food!']);
    }
    

    private function getValueAndUnit($text)
    {
        preg_match('/^(\d+)(\D+)/', $text, $matches);

        if (!empty($matches)) {

            return [
                'value' => $matches[1],
                'unit' => $matches[2],
            ];
        }

        return [
            'value' => 1,
            'unit' => 'g',
        ];
    }
}
