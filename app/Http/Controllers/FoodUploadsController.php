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
use App\Http\Requests\ValidateFoodUpdateRequest;
use Str;
use Yajra\Datatables\Datatables;

class FoodUploadsController extends Controller
{

    public function index()
    {
        return view('foods');
    }


    public function data()
    {
        $foods = Food::query();

        return Datatables::of($foods)
            ->editColumn('title_image', function ($model) {
                return '<img src="' . $model->title_image . '" class="small-img" />';
            })
            ->editColumn('calories', function ($model) {
                return $model->calories . $model->calories_unit;
            })
            ->editColumn('serving_size', function ($model) {
                return $model->serving_size . $model->serving_size_unit;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($model) {
                return $model->updated_at->format('Y-m-d');
            })
            ->editColumn('description_slug', function ($model) {
                return '<a href="/foods/' . $model->description_slug . '" class="btn btn-sm btn-outline-secondary">Edit</a>';
            })
            ->rawColumns(['title_image', 'description_slug'])
            ->make(true);
    }


    public function create()
    {
        $food_upload = FoodUpload::orderBy('created_at', 'ASC')->first();
        $nutrients = Nutrient::whereNull('parent_id')->get();

        $remaining = FoodUpload::count();

        $food_count = Food::count();

        $excluded_top_level = ['Vitamins', 'Minerals', 'Others'];

        $target_age_groups = array_keys(Food::TARGET_AGE_GROUPS);

        return view('create-food', [
            'food_upload' => $food_upload,
            'nutrients' => $nutrients,
            'excluded_top_level' => $excluded_top_level,
            'remaining' => $remaining,
            'food_count' => $food_count,
            'target_age_groups' => $target_age_groups, 
            'default_age_group' => Food::DEFAULT_AGE_GROUP,
            'food_types' => Food::FOOD_TYPES,
            'default_food_type' => Food::DEFAULT_FOOD_TYPE,
        ]);
    }


    public function store(ValidateFoodUploadRequest $request) 
    {
        $data = $request->except(['id', '_token']);
      
        $nutrients_data = $request->except([
            'id', '_token', 'target_age_group', 'food_type', 'allergen_information', 'origin_country', 
            'description', 'barcode', 'ingredients', 'serving_size', 'servings_per_container', 'weight', 'calories'
        ]);
       
        $calories_and_unit = $this->getValueAndUnit($data['calories']);
        $serving_size_and_unit = $this->getValueAndUnit($data['serving_size']);

        $weight_and_unit = $this->getValueAndUnit($data['weight']);

        $id = request('id');
        $food_upload = FoodUpload::find($id);
        

        $food = Food::create([
            'description' => $data['description'], 
            'allergen_information' => $data['allergen_information'],
            'description_slug' => Str::slug($data['description']),
            'food_type' => $data['food_type'],
            'calories' => $calories_and_unit['value'],
            'calories_unit' => $calories_and_unit['unit'], 
            'serving_size' => $serving_size_and_unit['value'],
            'serving_size_unit' => $serving_size_and_unit['unit'], 
            'servings_per_container' => $data['servings_per_container'],
            'weight' => $weight_and_unit['value'],
            'weight_unit' => $weight_and_unit['unit'],

            'title_image' => $food_upload->title_image,
            'nutrition_label_image' => $food_upload->nutrition_label_image,
            'barcode_image' => $food_upload->barcode_image,
            
            'ingredients' => $data['ingredients'],
            'ingredients_image' => $food_upload->ingredients_image,

            'target_age_group' => $data['target_age_group'],
            'country' => $data['origin_country'],
        ]);

        if ($request->has('barcode') && $request->input('barcode') != null) {
          
            FoodBarcode::create([
                'food_id' => $food->id,
                'barcode' => request('barcode'), 
            ]);
            
        }

        $this->saveFoodNutrients($food, $nutrients_data);

        $food_upload->delete();

        return back()
            ->with('alert', ['type' => 'success', 'text' => 'Successfully added food!']);
    }


    private function saveFoodNutrients($food, $nutrients_data)
    {
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

                                $nutrient_name = str_replace('_', ' ', strtolower($child_key));

                                $nutrient_exists = FoodNutrient::where('food_id', $food->id)
                                    ->where('name', $nutrient_name)
                                    ->first();

                                if ($nutrient_exists) {
                                    FoodNutrient::where('food_id', $food->id)
                                        ->where('name', $nutrient_name)
                                        ->update([
                                            'amount' => $branch_nutrient_and_unit['value'],
                                            'unit' => $branch_nutrient_and_unit['unit']
                                        ]);
                                } else {
                                    FoodNutrient::create([
                                        'food_id' => $food->id,
                                        'parent_nutrient_id' => $trunk_nutrient_id,
                                        'name' => $nutrient_name,
                                        'amount' => $branch_nutrient_and_unit['value'],
                                        'unit' => $branch_nutrient_and_unit['unit'],   
                                    ]);
                                    
                                }
                            }

                        }
                    } else {
                       
                        if ($parent_row) {

                            $trunk_nutrient_and_unit = $this->getValueAndUnit($parent_row);

                            $root_nutrient_id = isset($roots[strtolower($root_key)]) ? $roots[strtolower($root_key)] : null;

                            $trunk_nutrient_name = str_replace('_', ' ', strtolower($parent_key));

                            $trunk_nutrient_exists = FoodNutrient::where('food_id', $food->id)
                                ->where('name', $trunk_nutrient_name)
                                ->first();

                            if ($trunk_nutrient_exists) {
                                FoodNutrient::where('food_id', $food->id)
                                    ->where('name', $trunk_nutrient_name)
                                    ->update([
                                        'amount' => $trunk_nutrient_and_unit['value'],
                                        'unit' => $trunk_nutrient_and_unit['unit']
                                    ]);
                                $trunk_nutrient_id = $trunk_nutrient_exists->id;
                            } else {
                                $trunk_nutrient = FoodNutrient::create([
                                    'food_id' => $food->id,
                                    'parent_nutrient_id' => $root_nutrient_id,
                                    'name' => $trunk_nutrient_name,
                                    'amount' => $trunk_nutrient_and_unit['value'],
                                    'unit' => $trunk_nutrient_and_unit['unit'],   
                                ]);
                               
                                $trunk_nutrient_id = $trunk_nutrient->id;
                            }

                            $trunks[strtolower($parent_key)] = $trunk_nutrient_id; 

                        }
                    }
                } 
            } else {
                
                if ($root_row) {

                    $root_nutrient_and_unit = $this->getValueAndUnit($root_row);

                    $root_nutrient_name = str_replace('_', ' ', strtolower($root_key));

                    $root_nutrient_exists = FoodNutrient::where('food_id', $food->id)
                        ->where('name', $root_nutrient_name)
                        ->first();

                    if ($root_nutrient_exists) {
                        FoodNutrient::where('food_id', $food->id)
                            ->where('name', $root_nutrient_name)
                            ->update([
                                'amount' => $root_nutrient_and_unit['value'],
                                'unit' => $root_nutrient_and_unit['unit']
                            ]);
                        $root_nutrient_id = $root_nutrient_exists->id;

                    } else {
                       
                        $root_nutrient = FoodNutrient::create([
                            'food_id' => $food->id,
                            'parent_nutrient_id' => null,
                            'name' => $root_nutrient_name,
                            'amount' => $root_nutrient_and_unit['value'],
                            'unit' => $root_nutrient_and_unit['unit'],   
                        ]);
                        
                        $root_nutrient_id = $root_nutrient->id;
                    }

                    $roots[strtolower($root_key)] = $root_nutrient_id; 
                }
            }
        }
    }
    

    private function getValueAndUnit($text)
    {
        preg_match('/^([\d.]+)(\D+)/', $text, $matches);

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


    public function edit(Food $food)
    {
        $food->load('barcode', 'nutrients');
       
        $food_nutrients = $food->nutrients()->get();
        
        $nutrients = Nutrient::whereNull('parent_id')->get();
        $excluded_top_level = ['Vitamins', 'Minerals', 'Others'];

        $target_age_groups = array_keys(Food::TARGET_AGE_GROUPS);

        return view('edit-food', [
            'food' => $food,
            'food_nutrients' => $food_nutrients,
            'nutrients' => $nutrients,
            'excluded_top_level' => $excluded_top_level,
            'target_age_groups' => $target_age_groups,
            'default_age_group' => Food::DEFAULT_AGE_GROUP,
            'food_types' => Food::FOOD_TYPES,
            'default_food_type' => Food::DEFAULT_FOOD_TYPE,
        ]);
    }


    public function update(Food $food, ValidateFoodUpdateRequest $request)
    {
        $calories_and_unit = $this->getValueAndUnit($request->calories);
        $serving_size_and_unit = $this->getValueAndUnit($request->serving_size);

        $weight_and_unit = $this->getValueAndUnit($request->weight);

        Food::where('id', $food->id)
            ->update([
                'description' => $request->description,
                'calories' => $calories_and_unit['value'],
                'calories_unit' => $calories_and_unit['unit'],
                'serving_size' => $serving_size_and_unit['value'],
                'serving_size_unit' => $serving_size_and_unit['unit'],
                'servings_per_container' => $request->servings_per_container,
                'weight' => $weight_and_unit['value'],
                'weight_unit' => $weight_and_unit['unit'],

                'target_age_group' => $request->target_age_group,
                'origin_country' => $request->origin_country,
                'allergen_information' => $request->allergen_information,
                'food_type' => $request->food_type,
            ]);
        
        if ($food->barcode && $request->barcode) {
            
            FoodBarcode::where('food_id', $food->id)
                ->update([
                    'barcode' => $request->barcode,
                ]); 

        } else if ($request->barcode) {
            FoodBarcode::create([
                'food_id' => $food->id,
                'barcode' => $request->barcode, 
            ]);
        }


        $nutrients_data = $request->except([
            'id', '_token', '_method', 
            'target_age_group', 'allergen_information', 'origin_country',
            'description', 'barcode', 'ingredients', 'serving_size', 'servings_per_container', 'weight', 'calories']);

        $this->saveFoodNutrients($food, $nutrients_data);

        return back()
            ->with('alert', ['type' => 'success', 'text' => 'Food updated!']);
    }
}
