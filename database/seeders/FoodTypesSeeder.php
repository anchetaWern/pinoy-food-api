<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodType;
use Str;

class FoodTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food_types = json_decode(file_get_contents(storage_path('app/food-subtypes.json')), true);
        foreach ($food_types as $type) {
            $created_food_type = FoodType::create([
                'name' => $type['name'],
                'slug' => Str::slug($type['name']),
            ]);

            if (isset($type['subtypes'])) {
                foreach ($type['subtypes'] as $subtype) {
                    FoodType::create([
                        'name' => $subtype,
                        'slug' => Str::slug($subtype),
                        'parent_id' => $created_food_type->id,
                    ]);
                }
            }
        }
    }
}
