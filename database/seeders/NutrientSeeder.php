<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nutrient;
use Illuminate\Support\Facades\Storage;

class NutrientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = Storage::get('data/nutrients.json');

        $data = json_decode($content, true);

        foreach ($data as $key => $value) {
            if ($value !== true) {
               
                if (!is_integer($key)) {
                    
                    $nutrient = Nutrient::create([
                        'name' => $key,
                        'parent_id' => null,
                        'created_at' => now(),
                    ]);

                    foreach ($value as $inner_key => $child) {

                        if (is_array($child)) {
                            
                            $inner_nutrient = Nutrient::create([
                                'name' => $inner_key,
                                'parent_id' => $nutrient->id,
                                'created_at' => now(),
                            ]);
                            
                            foreach ($child as $grand_child) {
                                Nutrient::create([
                                    'name' => $grand_child,
                                    'parent_id' => $inner_nutrient->id,
                                    'created_at' => now(),
                                ]);
                            }

                        } else {
                            if ($child === true) {
                                Nutrient::create([
                                    'name' => $inner_key,
                                    'parent_id' => $nutrient->id,
                                    'created_at' => now(),
                                ]);
                            } else {
                                Nutrient::create([
                                    'name' => $child,
                                    'parent_id' => $nutrient->id,
                                    'created_at' => now(),
                                ]);
                            }
                            
                        }
                       
                    }
                }

                
            } else {
                Nutrient::create([
                    'name' => $key,
                    'parent_id' => null,
                    'created_at' => now(),
                ]);
            }
        }
    }
}
