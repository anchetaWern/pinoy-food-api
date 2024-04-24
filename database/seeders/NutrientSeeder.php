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


        $nutrients_in_milligrams = [
            'Cholesterol', 'Vitamin C', 'Iron', 'Zinc', 'Iodine',
            'Calcium', 'Magnesium', 'Phosphorus', 'Fluoride', 'Vitamin B6',
            'Sodium', 'Chloride', 'Potassium',
        ];

        $nutrients_in_grams = [
            'Protein', 'Total Carbohydrates', 'Dietary fiber', 'Soluble', 'Insoluble', 'Sugar', 
            'Total Fat', 'Saturated fat', 'Trans fat', 'Unsaturated fat'
        ];

        foreach ($nutrients_in_milligrams as $nutrient_in_mg) {
            Nutrient::where('name', $nutrient_in_mg)
                ->update([
                    'placeholder_text' => mt_rand(10, 20) . 'mg'
                ]);
        }


        foreach ($nutrients_in_grams as $nutrient_in_g) {
            Nutrient::where('name', $nutrient_in_g)
                ->update([
                    'placeholder_text' => mt_rand(1, 100) . 'g'
                ]);
        }
    }
}
