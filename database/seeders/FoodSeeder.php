<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\FoodNutrient;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gold_seas = Food::create([
            'description' => 'Gold seas tuna chunks in springwater', 
            'calories' => 90,
            'calories_unit' => 'kcal',
            'serving_size' => 56,
            'serving_size_unit' => 'g',
            'servings_per_container' => 3,
        ]);

        $gold_seas_nutrients = [
            [
                'name' => 'Carbohydrates',
                'amount' => 0.5,
                'unit' => 'g',
            ],
            [
                'name' => 'Protein',
                'amount' => 13,
                'unit' => 'g',
            ],
            [
                'name' => 'Fat',
                'amount' => 0.4,
                'unit' => 'g',
                'composition' => [
                    [
                        'name' => 'Omega3',
                        'amount' => 62,
                        'unit' => 'mg'
                    ],
                    [
                        'name' => 'DHA',
                        'amount' => 50,
                        'unit' => 'mg'
                    ]
                ]
            ],
            [
                'name' => 'Sodium',
                'amount' => 47,
                'unit' => 'mg'
            ]
        ];

        foreach ($gold_seas_nutrients as $gold_seas_n) {
            $gsn_nutrient = FoodNutrient::create([
                'food_id' => $gold_seas->id,
                'name' => $gold_seas_n['name'],
                'amount' => $gold_seas_n['amount'],
                'unit' => $gold_seas_n['unit'],   
            ]);

            if (isset($gold_seas_n['composition'])) {
                foreach ($gold_seas_n['composition'] as $gsn_composition) {

                    FoodNutrient::create([
                        'food_id' => $gold_seas->id,
                        'parent_nutrient_id' => $gsn_nutrient->id,
                        'name' => $gsn_composition['name'],
                        'amount' => $gsn_composition['amount'],
                        'unit' => $gsn_composition['unit'],   
                    ]);
                }
            }
        }
        

        $oats = Food::create([
            'description' => 'Australia harvest oat bran', 
            'calories' => 160,
            'calories_unit' => 'kcal',
            'serving_size' => 56,
            'serving_size_unit' => 'g',
            'servings_per_container' => 12,
        ]);

        $oats_nutrients = [
            [
                'name' => 'Carbohydrates',
                'amount' => 26,
                'unit' => 'g',
            ],
            [
                'name' => 'Protein',
                'amount' => 5,
                'unit' => 'g',
            ],
            [
                'name' => 'Fiber',
                'amount' => 5.5,
                'unit' => 'g',
                'composition' => [
                    [
                        'name' => 'Solluble',
                        'amount' => 2,
                        'unit' => 'g',
                    ]
                ],
            ],
            [
                'name' => 'Fat',
                'amount' => 3,
                'unit' => 'g',
                'composition' => [
                    [
                        'name' => 'Cholesterol',
                        'amount' => 0,
                        'unit' => 'mg'
                    ],
                    [
                        'name' => 'Saturated Fat',
                        'amount' => 1,
                        'unit' => 'g',
                    ],
                    [
                        'name' => 'TransFat',
                        'amount' => 0,
                        'unit' => 'g',
                    ]
                ]
            ],
            [
                'name' => 'Sodium',
                'amount' => 0,
                'unit' => 'mg'
            ],
            [
                'name' => 'Sugar',
                'amount' => 2,
                'unit' => 'g'
            ]
        ];

        foreach ($oats_nutrients as $oats_n) {
            $oats_nutrient = FoodNutrient::create([
                'food_id' => $oats->id,
                'name' => $oats_n['name'],
                'amount' => $oats_n['amount'],
                'unit' => $oats_n['unit'],   
            ]);

            if (isset($oats_n['composition'])) {
                foreach ($oats_n['composition'] as $oatsn_composition) {

                    FoodNutrient::create([
                        'food_id' => $oats->id,
                        'parent_nutrient_id' => $oats_nutrient->id,
                        'name' => $oatsn_composition['name'],
                        'amount' => $oatsn_composition['amount'],
                        'unit' => $oatsn_composition['unit'],   
                    ]);
                }
            }
        }
        

        $bread = Food::create([
            'description' => 'Gardenia wheat bread', 
            'calories' => 150,
            'calories_unit' => 'kcal',
            'serving_size' => 2,
            'serving_size_unit' => 'slices',
            'servings_per_container' => 7,
        ]);

        $bread_nutrients = [
            [
                'name' => 'Fat',
                'amount' => 2,
                'unit' => 'mg',
                'composition' => [
                    [
                        'name' => 'Saturated Fat',
                        'amount' => 1,
                        'unit' => 'g',
                    ],
                    [
                        'name' => 'Trans Fat',
                        'amount' => 0,
                        'unit' => 'g',
                    ],
                    [
                        'name' => 'Cholesterol',
                        'amount' => 0,
                        'unit' => 'mg',
                    ]
                ],
            ],

            [
                'name' => 'Sodium',
                'amount' => 211,
                'unit' => 'mg',
            ],

            [
                'name' => 'Carbohydrate',
                'amount' => 26,
                'unit' => 'g',
                'composition' => [
                    [
                        'name' => 'Soluble Fiber',
                        'amount' => 1,
                        'unit' => 'g',
                    ],
                    [
                        'name' => 'Insoluble',
                        'amount' => 5,
                        'unit' => 'g',
                    ],
                    [
                        'name' => 'Sugars',
                        'amount' => 3,
                        'unit' => 'g',
                    ]
                ]
            ],

            [
                'name' => 'Protein',
                'amount' => 7,
                'unit' => 'g',
            ]
        
        ];

        foreach ($bread_nutrients as $bread_n) {
            $bread_n = FoodNutrient::create([
                'food_id' => $bread->id,
                'name' => $bread_n['name'],
                'amount' => $bread_n['amount'],
                'unit' => $bread_n['unit'],   
            ]);

            if (isset($bread_n['composition'])) {
                foreach ($bread_n['composition'] as $breadn_composition) {

                    FoodNutrient::create([
                        'food_id' => $bread->id,
                        'parent_nutrient_id' => $bread_n->id,
                        'name' => $breadn_composition['name'],
                        'amount' => $breadn_composition['amount'],
                        'unit' => $breadn_composition['unit'],   
                    ]);
                }
            }
        }
    }
}
