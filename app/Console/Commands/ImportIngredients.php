<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Food;
use App\Models\Ingredient;
use App\Models\FoodIngredient;
use Illuminate\Support\Facades\Storage;

class ImportIngredients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingredients:import {slug} {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import ingredients data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $food_slug = $this->argument('slug');
        $file = $this->argument('file');
        $ingredients_str = Storage::get('data/ingredients/' . $file);
        $ingredients_data = json_decode($ingredients_str, true);
        
        Food::where('description_slug', $food_slug) 
            ->update([
                'summary' => $ingredients_data['summary'],
            ]);

        $food = Food::where('description_slug', $food_slug) 
                ->first();

        foreach ($ingredients_data['ingredients'] as $row) {
            $ingredient = Ingredient::where('name', 'LIKE', '%' . $row['name'] . '%')
                ->first();

            if (!$ingredient) {
                $ingredient = Ingredient::create([
                    'name' => $row['name'],
                    'effects' => $row['effects'],
                    'health_risks' => $row['health_risks'],
                    'score' => $row['score'],
                ]);
            }

            FoodIngredient::create([
                'food_id' => $food->id,
                'ingredient_id' => $ingredient->id,
            ]);
        }
    }
}
