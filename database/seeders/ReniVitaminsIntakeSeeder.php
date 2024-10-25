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
            [
                age_from
                age_to

                age_type

                male_energy_req_in_kcal
                female_energy_req_in_kcal

                male_weight_in_kg
                female_weight_in_kg

                male_protein_in_g
                female_protein_in_g
                
                male_vitamin_a
                female_vitamin_a

                male_vitamin_c
                female_vitamin_c

                male_vitamin_b1 (thiamin)
                female_vitamin_b1 

                male_vitamin_b2 (riboflavin)
                female_vitamin_b2

                male_vitamin_b3 (niacin)
                female_vitamin_b3

                male_vitamin_b9 (folate)
                female_vitamin_b9

                male_vitamin_d
                female_vitamin_d

                male_vitamin_e
                female_vitamin_e

                male_vitamin_k
                female_vitamin_k

                male_vitamin_b6 (pyridoxine)
                female_vitamin_b6

                male_vitamin_b12 (cobalamin)
                female_vitamin_b12
            ]
        */

        $data = [
            [
                0, 5,
                'month',

                560, 560,
                6, 6,
                9, 9,

                375, 375,
                30, 30,
                
                0.2, 0.2,
                0.3, 0.2,
                1.5, 1.5,
                65, 65,

                5, 5,
                3, 3,
                6, 6,
                
                0.1, 0.1,
                0.3, 0.3,
               
            ],

            [

                6, 11, 
                'month',

                720, 720,
                9, 9,
                14, 14,

                400, 400,
                30, 30,

                0.4, 0.4,
                0.4, 0.4,
                4, 4,
                80, 80,

                5, 5,
                4, 4,
                9, 9,

                0.3, 0.3,
                0.4, 0.4,
            ],

            [

                1, 3, 
                'year',

                1070, 1070,
                13, 13,
                28, 28,

                400, 400,
                30, 30,
                
                0.5, 0.5,
                0.5, 0.5,
                6, 6,
                160, 160,

                5, 5,
                5, 5,
                13, 13,

                0.5, 0.5,
                0.9, 0.9,
            ],


            [
                4, 6,
                'year',

                1410, 1410,
                19, 19,
                38, 38,

                400, 400,
                30, 30,

                0.6, 0.6,
                0.6, 0.6,
                
                7, 7,
                200, 200,

                5, 5,
                6, 6,
                19, 19,

                0.6, 0.6,
                1.2, 1.2,
            ],

            [
                7, 9,
                'year',

                1600, 1600,
                24, 24,
                43, 43,

                400, 400,
                35, 35,

                0.7, 0.7,
                0.7, 0.7,
                
                9, 9,
                300, 300,

                5, 5,
                7, 7,
                24, 24,

                1.0, 1.0,
                1.8, 1.8,
            ],

            [
                10, 12,
                'year',

                2140, 1920,
                34, 35,
                54, 49,

                400, 400,
                45, 45,

                0.9, 0.9,
                1.0, 0.9,
                12, 12,
                400, 400,
                
                5, 5, 
                10, 11,
                34, 35, 

                1.3, 1.2,
                2.4, 2.4,
            ],

            [
                13, 15,
                'year',
                
                2800, 2250,
                50, 49,
                71, 63,

                550, 450,
                65, 65,

                1.2, 1.0,
                1.3, 1.0,
                16, 14,
                400, 400,

                5, 5,
                12, 12,
                50, 49,

                1.3, 1.2,
                2.4, 2.4,
            ],

            [
                16, 18,
                'year',
                
                2840, 2050,
                58, 50,
                73, 59,

                600, 450,
                75, 70,
                
                1.4, 1.1,
                1.5, 1.1,
                16, 14,
                400, 400,

                5, 5, 
                13, 12,
                58, 50,

                1.3, 1.2,
                2.4, 2.4,
            ],

            [
                19, 29,
                'year',
                
                2490, 1860,
                59, 51,
                67, 58,

                550, 500,
                75, 70,

                1.2, 1.1,
                1.3, 1.1,
                16, 14,
                400, 400,

                5, 5, 
                12, 12,
                59, 51,

                1.3, 1.3,
                2.4, 2.4,

            ],

            [
                30, 49,
                'year',
                
                1810, 1810,
                59, 51,
                67, 58,

                550, 500,
                75, 70,
                
                1.2, 1.1,
                1.3, 1.1,
                16, 14,
                400, 400,

                5, 5,
                12, 12,
                59, 51,

                1.3, 1.3,
                2.4, 2.4
            ],

            [
                50, 64,
                'year',
                
                2170, 1620,
                59, 51,
                67, 58,

                550, 500,
                75, 70,

                1.2, 1.1,
                1.3, 1.1,
                16, 14,
                400, 400,

                10, 10,
                12, 12,
                59, 51,

                1.7, 1.5,
                2.4, 2.4,
            ],


            [
                65, null,
                'year',
                
                1890, 1410,
                59, 51,
                67, 68,

                550, 500,
                75, 70,

                1.2, 1.1,
                1.3, 1.1,
                16, 14,
                400, 400,

                15, 15,
                12, 12,
                59, 51,

                1.7, 1.5,
                2.4, 2.4,
            ],
            

        ];

        foreach ($data as $item) {
            DB::table('reni_vitamins_intake')
                ->insert([

                    'age_from' => $item[0], 
                    'age_to' => $item[1],
                    'age_type' => $item[2],

                    'male_energy_req_in_kcal' => $item[3], 
                    'female_energy_req_in_kcal' => $item[4],

                    'male_weight_in_kg' => $item[5],  
                    'female_weight_in_kg' => $item[6],
                    'male_protein_in_g' => $item[7], 
                    'female_protein_in_g' => $item[8],

                    'male_vitamin_a' => $item[9], 
                    'female_vitamin_a' => $item[10],
                    'male_vitamin_c' => $item[11],  
                    'female_vitamin_c' => $item[12],

                    'male_vitamin_b1' => $item[13],
                    'female_vitamin_b1' => $item[14], 
                    'male_vitamin_b2' => $item[15],  
                    'female_vitamin_b2' => $item[16],
                    'male_vitamin_b3' => $item[17], 
                    'female_vitamin_b3' => $item[18],
                    'male_vitamin_b9' => $item[19], 
                    'female_vitamin_b9' => $item[20],

                    'male_vitamin_d' => $item[21], 
                    'female_vitamin_d' => $item[22],
                    'male_vitamin_e' => $item[23], 
                    'female_vitamin_e' => $item[24],
                    'male_vitamin_k' => $item[25], 
                    'female_vitamin_k' => $item[26],

                    'male_vitamin_b6' => $item[27], 
                    'female_vitamin_b6' => $item[28],
                    'male_vitamin_b12' => $item[29], 
                    'female_vitamin_b12' => $item[30],

                    'created_at' => now(),
                    'updated_at' => now(),

                ]);
        }
    }
}
