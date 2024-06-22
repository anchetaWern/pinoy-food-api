<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodState;

class FoodStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food_states = json_decode(file_get_contents(storage_path('app/physical-state-food-categories.json')), true);
        foreach ($food_states as $state) {
            $created_food_state = FoodState::create([
                'name' => $state['name'],
            ]);

            if (isset($state['subcategories'])) {
                foreach ($state['subcategories'] as $sub) {
                    FoodState::create([
                        'name' => $sub,
                        'parent_id' => $created_food_state->id
                    ]);
                }
            }
        }
    }
}
