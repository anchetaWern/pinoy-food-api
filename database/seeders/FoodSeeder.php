<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::create([
            'description' => 'Gold seas tuna chunks in springwater', 
            'calories' => 90,
            'calories_unit' => 'kcal',
            'serving_size' => 56,
            'serving_size_unit' => 'g',
            'servings_per_container' => 3,
            'nutrients' => [
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
            ],
        ]);


        Food::create([
            'description' => 'Australia harvest oat bran', 
            'calories' => 160,
            'calories_unit' => 'kcal',
            'serving_size' => 56,
            'serving_size_unit' => 'g',
            'servings_per_container' => 12,
            'nutrients' => [
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
            ],
        ]);
        

        Food::create([
            'description' => 'Gardenia wheat bread', 
            'calories' => 150,
            'calories_unit' => 'kcal',
            'serving_size' => 2,
            'serving_size_unit' => 'slices',
            'servings_per_container' => 7,
            'nutrients' => [
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
            
            ]
        ]);
    }
}
