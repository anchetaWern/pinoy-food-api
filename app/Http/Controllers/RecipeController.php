<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodNutrient;
use App\Models\RecipeIngredient;
use Illuminate\Support\Facades\Storage;
use Str;

class RecipeController extends Controller
{

    private function getExtensionFromMimeType($mime_type)
    {
        switch ($mime_type) {
            case 'jpeg':
            case 'jpg':
                return 'jpg';
            case 'png':
                return 'png';
            case 'gif':
                return 'gif';
           
            default:
                return 'jpg'; 
        }
    }


    public function __invoke(Request $request)
    {
        $title = Str::random(40);
        $title_image = $request->input('image');
        preg_match('/^data:image\/(\w+);base64,/', $title_image, $title_image_matches);
        $title_image_mime_type = $title_image_matches[1] ?? null;
        $title_image_extension = $this->getExtensionFromMimeType($title_image_mime_type);

        $title_image_data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $title_image), true);

        $image_title = Str::slug(now()->format('Y-m-d H:i') . '-title-' . $title) . '.' . $title_image_extension;
        Storage::disk('public')->put($image_title, $title_image_data);

        $food_data = [
            'description' => request('name'),
            'title_image' => $image_title,
            'description_slug' => Str::slug(request('name')),
        
            'serving_size' => request('serving_size'),
            'serving_size_unit' => 'g',
            'servings_per_container' => request('serving_count'),
            'calories' => request('calories'),
            'calories_unit' => 'kcal',

            'food_type' => 57, // prepared and processed
            'food_subtype' => 73, // cooked meals
            'food_state' => request('food_state'),
        ];

        $new_food = Food::create($food_data);

        // recipe ingredients
        $ingredients = request('ingredients');
        foreach ($ingredients as $ingredient) {
            
            $ingredient_id = Food::where('description_slug', $ingredient['slug'])->value('id');

            RecipeIngredient::create([
                'recipe_id' => $new_food->id,
                'ingredient_id' => $ingredient_id,
                'serving_size' => $ingredient['serving_size'],
                'serving_size_unit' => $ingredient['serving_size_unit'],
            ]);
        }
       

        $nutrients = request('nutrients');

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

        return 'ok';
    }
}
