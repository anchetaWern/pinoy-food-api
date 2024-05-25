<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FdaDailyValuesForNutrient;

class FdaDailyValuesForNutrientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nutrients = [
            [
                'nutrient' => 'sugar',
                'daily_value' => 50,
                'unit' => 'g'
            ],
            [
                'nutrient' => 'biotin',
                'daily_value' => 30,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'calcium',
                'daily_value' => 1300,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'chloride',
                'daily_value' => 2300,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'choline',
                'daily_value' => 550,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'cholesterol',
                'daily_value' => 300,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'chromium',
                'daily_value' => 35,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'copper',
                'daily_value' => 0.9,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'total fiber',
                'daily_value' => 28,
                'unit' => 'g'
            ],
            [
                'nutrient' => 'total fat',
                'daily_value' => 78,
                'unit' => 'g'
            ],
            [
                'nutrient' => 'vitamin b9', // folate
                'daily_value' => 400,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'iodine',
                'daily_value' => 150,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'iron',
                'daily_value' => 18,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'magnesium',
                'daily_value' => 420,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'manganese',
                'daily_value' => 2.3,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'molybdenum',
                'daily_value' => 45,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'vitamin b3', // niacin
                'daily_value' => 16,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'vitamin b5', // pantothenic acid
                'daily_value' => 5,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'phosphorus',
                'daily_value' => 1250,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'potassium',
                'daily_value' => 4700,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'protein',
                'daily_value' => 50,
                'unit' => 'g'
            ],
            [
                'nutrient' => 'vitamin b2',
                'daily_value' => 1.3,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'saturated fat',
                'daily_value' => 20,
                'unit' => 'g'
            ],
            [
                'nutrient' => 'selenium',
                'daily_value' => 55,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'sodium',
                'daily_value' => 2300,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'thiamin',
                'daily_value' => 1.2,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'total carbohydrates',
                'daily_value' => 275,
                'unit' => 'g'
            ],
            [
                'nutrient' => 'vitamin a',
                'daily_value' => 900, 
                'unit' => 'mcg' // mcg RAE
            ],
            [
                'nutrient' => 'vitamin b6', // pyridoxine
                'daily_value' => 1.7,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'vitamin b12', // cobalamin
                'daily_value' => 2.4,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'vitamin c',
                'daily_value' => 90,
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'vitamin d',
                'daily_value' => 20,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'vitamin e', 
                'daily_value' => 15, // alpha-tocopherol
                'unit' => 'mg'
            ],
            [
                'nutrient' => 'vitamin k',
                'daily_value' => 120,
                'unit' => 'mcg'
            ],
            [
                'nutrient' => 'zinc',
                'daily_value' => 11,
                'unit' => 'mg'
            ],
        ];

        foreach ($nutrients as $row) {
            FdaDailyValuesForNutrient::create($row);
        }

    }
}
