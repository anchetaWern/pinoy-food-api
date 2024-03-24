<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReniVitaminsIntakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        'age_from', 'age_to', 'age_type',
        'male_vitamin_a', 'female_vitamin_a',
        'male_vitamin_d', 'female_vitamin_d',
        'male_vitamin_e', 'female_vitamin_e',
        'male_vitamin_k', 'female_vitamin_k',
        'male_thiamin', 'female_thiamin',
        'male_riboflavin', 'female_riboflavin',
        'male_niacin', 'female_niacin',
        'male_pyridoxine', 'female_pyridoxine',
        'male_cobalamin', 'female_cobalamin',
        'male_folate', 'female_folate',
        'male_vitamin_c', 'female_vitamin_c', 
        */
        
        $data = [
            [
                0, 5, 'month',
                
                380, 380,

                5, 5,

                3, 3,

                7, 6, 

                0.2, 0.2,

                0.3, 0.3,

                1, 1,

                0.1, 0.1,

                0.3, 0.3,

                65, 65,

                30, 30,
            ],

            [
                6, 11, 'month',
                
                400, 400,

                5, 5,

                4, 4,

                9, 8,

                0.4, 0.3,

                0.4, 0.3,

                5, 5,

                0.2, 0.3,
                
                0.4, 0.4,

                80, 70,

                40, 40,
            ],

            [
                1, 2, 'year',

                400, 400,

                5, 5, 

                4, 4,

                12, 12,

                0.5, 0.4,

                0.5, 0.4,

                6, 6,

                0.5, 0.5,

                0.9, 1.0,

                150, 150,

                45, 45,
            ],

            [
                3, 5, 'year',
                
                400, 400,

                5, 5, 

                5, 5,

                18, 17,

                0.5, 0.5,

                0.6, 0.5,

                7, 7,

                0.6, 0.7,

                1.1, 1.2,

                200, 200,

                45, 45,
            ],

            [
                6, 9, 'year',

                400, 400,

                5, 5,

                6, 6,

                23, 23,

                0.7, 0.7,

                0.7, 0.7,

                9, 9,

                0.7, 0.8,

                1.3, 1.5,

                300, 300,

                45, 45,
            ],

            [
                10, 12, 'year',

                500, 500,

                5, 5, 
                
                7, 9, 
                
                33, 36,
                
                0.9, 0.9,
                
                1.0, 0.9, 
                
                11, 12, 
                
                1.0, 1.1, 
                
                1.8, 2.1, 
                
                300, 300, 
                
                45, 45,
            ],

            [
                13, 15, 'year',

                700, 500, 
                
                5, 5, 
                
                10, 9, 
                
                49, 46, 
                
                1.2, 1.0, 
                
                1.3, 1.0, 
                
                15, 13, 
                
                1.3, 1.2, 
                
                2.3, 2.2, 
                
                400, 400, 
                
                60, 55,
            ],

            [
                16, 18, 'year',

                800, 600, 
                
                5, 5, 
                
                11, 10, 
                
                59, 52, 
                
                1.4, 1.1, 
                
                1.5, 1.1, 
                
                18, 14, 
                
                1.5, 1.3, 
                
                2.7, 2.4, 
                
                400, 400, 
                
                70, 60,
            ],

            [
                19, 29, 'year',

                700, 600, 
                
                5, 5, 
                
                10, 10, 
                
                61, 53, 
                
                1.2, 1.1, 
                
                1.3, 1.1, 
                
                16, 14, 
                
                1.3, 1.3, 
                
                2.4, 2.4, 
                
                400, 400, 
                
                70, 60,
            ],

            [
                30, 49, 'year',

                700, 600, 
                
                5, 5, 
                
                10, 10, 
                
                61, 53, 
                
                1.2, 1.1, 
                
                1.3, 1.1, 
                
                16, 14, 
                
                1.3, 1.3, 
                
                2.4, 2.4, 
                
                400, 400, 
                
                70, 60,
            ],

            [
                50, 59, 'year',

                700, 600, 
                
                10, 10, 
                
                10, 10, 
                
                61, 53, 
                
                1.2, 1.1, 
                
                1.3, 1.1, 
                
                16, 14, 
                
                1.7, 1.6, 
                
                2.4, 2.4, 
                
                400, 400, 
                
                70, 60,
            ],

            [
                60, 69, 'year',

                700, 600, 
                
                15, 15, 
                
                10, 10, 
                
                61, 53, 
                
                1.2, 1.1, 
                
                1.3, 1.1, 
                
                16, 14, 
                
                1.7, 1.6, 
                
                2.4, 2.4, 
                
                400, 400, 
                
                70, 60,
            ],

            [
                70, null, 'year', 

                700, 600, 
                
                15, 15, 
                
                10, 10, 
                
                61, 53, 
                
                1.2, 1.1, 
                
                1.3, 1.1, 
                
                16, 14, 
                
                1.7, 1.6, 
                
                2.4, 2.4, 
                
                400, 400, 
                
                70, 60,
            ]
        ];
        
        foreach ($data as $row) {
            DB::table('reni_vitamins_intake')
                ->insert([
                    'age_from' => $row[0],
                    'age_to' => $row[1],

                    'male_vitamin_a' => $row[2],
                    'female_vitamin_a' => $row[3],

                    'male_vitamin_d' => $row[4],
                    'female_vitamin_d' => $row[5],

                    'male_vitamin_e' => $row[6],
                    'female_vitamin_e' => $row[7],

                    'male_vitamin_k' => $row[8],
                    'female_vitamin_k' => $row[9],

                    'male_thiamin' => $row[10],
                    'female_thiamin' => $row[11],

                    'male_riboflavin' => $row[12],
                    'female_riboflavin' => $row[13],

                    'male_niacin' => $row[14],
                    'female_niacin' => $row[15],

                    'male_pyridoxine' => $row[16],
                    'female_pyridoxine' => $row[17],

                    'male_cobalamin' => $row[18],
                    'female_cobalamin' => $row[19],

                    'male_folate' => $row[20],
                    'female_folate' => $row[21],

                    'male_vitamin_c' => $row[22],
                    'female_vitamin_c' => $row[23],
                    
                    'created_at' => now(),
                ]);
        }
    }
}
