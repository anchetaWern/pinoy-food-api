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
use App\Models\FoodType;
use App\Models\FoodState;


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


    public function create($id = '')
    { 
        $food_upload = null;
        if ($id !== '') {
            $food_upload = FoodUpload::where('id', $id)->first();
        }
        
        $nutrients = Nutrient::whereNull('parent_id')->get();

        $remaining = FoodUpload::count();

        $food_count = Food::count();

        $excluded_top_level = ['Vitamins', 'Minerals', 'Others'];

        $target_age_groups = array_keys(Food::TARGET_AGE_GROUPS);

        $food_types = FoodType::get()->toArray();
        $food_states = FoodState::get()->toArray();

        $bulk_uploads = collect(Storage::files('public/bulk_uploads'))->map(function ($item) {
            return str_replace('public/', '', $item);
        });

        return view('create-food', [
            'food_upload' => $food_upload,
            'nutrients' => $nutrients,
            'excluded_top_level' => $excluded_top_level,
            'remaining' => $remaining,
            'food_count' => $food_count,
            'target_age_groups' => $target_age_groups, 
            'default_age_group' => Food::DEFAULT_AGE_GROUP,
            'food_types' => $food_types,
            'food_states' => $food_states,
            'default_food_type' => Food::DEFAULT_FOOD_TYPE,
            'bulk_uploads' => $bulk_uploads,
        ]);
    }


    public function store(ValidateFoodUploadRequest $request) 
    {
        $food_upload = null;
        $data = $request->except(['id', '_token']);
      
        $nutrients_data = $request->except([
            'id', '_token', 'target_age_group', 'food_type', 'allergen_information', 'origin_country', 
            'description', 'alternate_names', 'barcode', 'ingredients', 'serving_size', 'servings_per_container', 'calories'
        ]);
       
        $calories_and_unit = getValueAndUnit($data['calories']);
        $serving_size_and_unit = getValueAndUnit($data['serving_size']);

        $calories = $calories_and_unit['value'];
        $calories_unit = $calories_and_unit['unit'];
        $serving_size = $serving_size_and_unit['value'];
        $serving_size_unit = $serving_size_and_unit['unit'];
        $servings_per_container = $data['servings_per_container'];

        $custom_serving_size = $data['custom_serving_size'];

        if ($request->input('nutrition_json')) {
            $nutrition_json_data = json_decode($request->input('nutrition_json'), true);

            $calories_and_unit = getValueAndUnit($nutrition_json_data['calories']);
            $serving_size_and_unit = getValueAndUnit($nutrition_json_data['serving_size']);
            
            //
            $calories = $calories_and_unit['value'];
            $calories_unit = $calories_and_unit['unit'];
            $serving_size = $serving_size_and_unit['value'];
            $serving_size_unit = $serving_size_and_unit['unit'];
            $servings_per_container = $nutrition_json_data['servings_per_container'];
        }

        $title_image_new_name = null;
        $nutrition_image_new_name = null;
        $ingredients_image_new_name = null;
        $barcode_image_new_name = null;

        $id = request('id');
        if (!empty($id)) {
            $food_upload = FoodUpload::find($id);
            
            $title_image_new_name = $food_upload->title_image;
            $nutrition_image_new_name = $food_upload->nutrition_label_image;
            $ingredients_image_new_name = $food_upload->ingredients_image;
            $barcode_image_new_name = $food_upload->barcode_image;
            
        } else {
            $title_image = request('title_image');
            $nutrition_image = request('nutrition_image');
            $ingredients_image = request('ingredients_image');
            $barcode_image = request('barcode_image');

            if (!empty($title_image)) {
                $title_image_new_name = Str::slug(now()->format('Y-m-d H:i') . '-title') . '-' . $title_image;
                Storage::disk('public')->move('bulk_uploads/' . $title_image, $title_image_new_name);
            }

            if (!empty($nutrition_image)) {
                $nutrition_image_new_name = Str::slug(now()->format('Y-m-d H:i') . '-nutrilabel') . '-' . $nutrition_image;
                Storage::disk('public')->move('bulk_uploads/' . $nutrition_image, $nutrition_image_new_name);
            }

            if (!empty($ingredients_image)) {
                $ingredients_image_new_name = Str::slug(now()->format('Y-m-d H:i') . '-ingredients') . '-' . $ingredients_image;
                Storage::disk('public')->move('bulk_uploads/' . $ingredients_image, $ingredients_image_new_name);
            }

            if (!empty($barcode_image)) {
                $barcode_image_new_name = Str::slug(now()->format('Y-m-d H:i') . '-barcode') . '-' . $barcode_image;
                Storage::disk('public')->move('bulk_uploads/' . $barcode_image, $barcode_image_new_name);
            }
        }
        
        
        $food = Food::create([
            'description' => $data['description'], 
            'description_slug' => Str::slug($data['description']),

            'alternate_names' => $data['alternate_names'],
            'ingredients' => $data['ingredients'],
            'allergen_information' => $data['allergen_information'],
            
            'food_type' => $data['food_type'],
            'food_subtype' => isset($data['food_subtype']) ? $data['food_subtype'] : null,

            'calories' => $calories,
            'calories_unit' => $calories_unit, 
            'serving_size' => $serving_size,
            'serving_size_unit' => $serving_size_unit, 
            'servings_per_container' => $servings_per_container,
            'custom_serving_size' => $custom_serving_size,

            'title_image' => $title_image_new_name,
            'nutrition_label_image' => $nutrition_image_new_name,
            'ingredients_image' => $ingredients_image_new_name,
            'barcode_image' => $barcode_image_new_name,

            'target_age_group' => $data['target_age_group'],
            'country' => $data['origin_country'],
        ]);

        if ($request->has('barcode') && $request->input('barcode') != null) {
          
            FoodBarcode::create([
                'food_id' => $food->id,
                'barcode' => request('barcode'), 
            ]);
            
        }

        if ($request->input('nutrition_json')) {
            $this->saveFoodNutrientsJson($food, $request->input('nutrition_json'));
        } else {
            $this->saveFoodNutrientsFields($food, $nutrients_data);
        }
        
        if ($food_upload) {
            $food_upload->delete();
        }
        

        return redirect('/food-uploads')
            ->with('alert', ['type' => 'success', 'text' => 'Successfully added food!']);
    }


    private function saveFoodNutrientsJson($food, $nutrients_json)
    {
        $nutrients_data = json_decode($nutrients_json, true);

        foreach ($nutrients_data['nutrients'] as $nut) {

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


    private function saveFoodNutrientsFields($food, $nutrients_data)
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

                                $branch_nutrient_and_unit = getValueAndUnit($child_row);

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
                                        'normalized_amount' => normalizeNutrientValue($branch_nutrient_and_unit['value'], $food->serving_size),
                                        'unit' => $branch_nutrient_and_unit['unit'],   
                                    ]);
                                    
                                }
                            }

                        }
                    } else {
                       
                        if ($parent_row) {

                            $trunk_nutrient_and_unit = getValueAndUnit($parent_row);

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
                                    'normalized_amount' => normalizeNutrientValue($trunk_nutrient_and_unit['value'], $food->serving_size),
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

                    $root_nutrient_and_unit = getValueAndUnit($root_row);

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
                            'normalized_amount' => normalizeNutrientValue($root_nutrient_and_unit['value'], $food->serving_size),
                            'unit' => $root_nutrient_and_unit['unit'],   
                        ]);
                        
                        $root_nutrient_id = $root_nutrient->id;
                    }

                    $roots[strtolower($root_key)] = $root_nutrient_id; 
                }
            }
        }
    }


    public function edit(Food $food)
    {
        $food->load('barcode', 'nutrients');
       
        $food_nutrients = $food->nutrients()->get();
        
        $nutrients = Nutrient::whereNull('parent_id')->get();
        $excluded_top_level = ['Vitamins', 'Minerals', 'Others'];

        $target_age_groups = array_keys(Food::TARGET_AGE_GROUPS);

        $food_types = FoodType::get()->toArray();
        $food_states = FoodState::get()->toArray();

        return view('edit-food', [
            'food' => $food,
            'food_nutrients' => $food_nutrients,
            'nutrients' => $nutrients,
            'excluded_top_level' => $excluded_top_level,
            'target_age_groups' => $target_age_groups,
            'default_age_group' => Food::DEFAULT_AGE_GROUP,
            'food_types' => $food_types, 
            'food_states' => $food_states,
            'default_food_type' => Food::DEFAULT_FOOD_TYPE,
        ]);
    }


    public function update(Food $food, ValidateFoodUpdateRequest $request)
    {
        $calories_and_unit = getValueAndUnit($request->calories);
        $serving_size_and_unit = getValueAndUnit($request->serving_size);

        Food::where('id', $food->id)
            ->update([
                'description' => $request->description,
                'alternate_names' => $request->alternate_names,
                'calories' => $calories_and_unit['value'],
                'calories_unit' => $calories_and_unit['unit'],
                'serving_size' => $serving_size_and_unit['value'],
                'serving_size_unit' => $serving_size_and_unit['unit'],
                'servings_per_container' => $request->servings_per_container,
                'custom_serving_size' => $request->custom_serving_size,
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
            'description', 'barcode', 'ingredients', 'serving_size', 'servings_per_container', 'calories']);

        $this->saveFoodNutrientsFields($food, $nutrients_data);

        return back()
            ->with('alert', ['type' => 'success', 'text' => 'Food updated!']);
    }
}
