<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAONutrientReferenceValue;

class FAONutrientReferenceValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nutrient' => 'protein',
                'daily_value' => 50,
                'unit' => 'g',
            ],
            [
                'nutrient' => 'vitamin a',
                'daily_value' => 800,
                'unit' => 'mcg',
            ],
            [
                'nutrient' => 'vitamin d',
                'daily_value' => 5,
                'unit' => 'mcg',
            ],
            [
                'nutrient' => 'vitamin c',
                'daily_value' => 60,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'vitamin b1',
                'daily_value' => 1.4,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'vitamin b2',
                'daily_value' => 1.6,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'vitamin b3',
                'daily_value' => 18,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'vitamin b6',
                'daily_value' => 2,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'vitamin b9',
                'daily_value' => 200,
                'unit' => 'mcg',
            ],
            [
                'nutrient' => 'vitamin b12',
                'daily_value' => 1,
                'unit' => 'mcg',
            ],
            [
                'nutrient' => 'calcium',
                'daily_value' => 800,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'magnesium',
                'daily_value' => 300,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'iron',
                'daily_value' => 14,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'zinc',
                'daily_value' => 15,
                'unit' => 'mg',
            ],
            [
                'nutrient' => 'iodine',
                'daily_value' => 150,
                'unit' => 'mcg',
            ]
        ];

        foreach ($data as $row) {
            FAONutrientReferenceValue::create($row);
        }
    }
}
