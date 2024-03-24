<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReniMacronutrientIntakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        'age_from', 'age_to', 'age_type',

        'male_protein_in_grams', 'female_protein_in_grams',

        'linolenic_acid', 'linoleic_acid',

        'fiber_from_in_grams', 'fiber_to_in_grams',

        'male_water_in_ml', 'female_water_in_ml', 
        */

        $data = [
            [
                0, 5, 'month',
                
                9, 8,

                0.5, 4.5, 

                null, null,

                680, 680,
            ],

            [
                6, 11, 'month',
                
                17, 15,

                0.5, 4.5,

                null, null, 

                890, 890,
            ],

            [
                1, 2, 'year',

                18, 17,

                0.5, 3.0,

                6, 7,

                1000, 920,
            ],

            [
                3, 5, 'year',
                
                22, 21,

                0.5, 2.0,

                8, 10,

                1350, 1260,
            ],

            [
                6, 9, 'year',

                30, 29,

                0.5, 2.0,

                11, 14,

                1600, 1470,
            ],

            [
                10, 12, 'year',

                43, 46,

                0.5, 2.0,

                15, 17,

                2060, 1980,
            ],

            [
                13, 15, 'year',

                62, 57,

                0.5, 2.0,

                18, 20,

                2700, 2170,
            ],

            [
                16, 18, 'year',

                72, 61,

                0.5, 2.0,

                21, 23,

                3010, 2280,
            ],

            [
                19, 29, 'year',

                71, 62,

                0.5, 2.0,

                20, 25,

                2530, 1930,
            ],

            [
                30, 49, 'year',

                71, 62,

                0.5, 2.0,

                20, 25,

                2420, 1870,
            ],

            [
                50, 59, 'year',

                71, 62,

                0.5, 2.0,

                20, 25,

                2420, 1870,
            ],

            [
                60, 69, 'year',

                71, 62,

                0.5, 2.0,

                20, 25,

                2140, 1610,
            ],

            [
                70, null, 'year', 

                71, 62,

                0.5, 2.0,

                20, 25,

                1960, 1540,
            ]
        ];


        foreach ($data as $row) {
            DB::table('reni_macronutrient_intake')
                ->insert([
                    'age_from' => $row[0], 
                    'age_to' => $row[1],

                    'male_protein_in_grams' => $row[2],
                    'female_protein_in_grams' => $row[3],

                    'linolenic_acid' => $row[4], 
                    'linoleic_acid' => $row[5],

                    'fiber_from_in_grams' => $row[6], 
                    'fiber_to_in_grams' => $row[7],

                    'male_water_in_ml' => $row[8], 
                    'female_water_in_ml' => $row[9],

                    'created_at' => now(),
                ]);
        }

    }
}
