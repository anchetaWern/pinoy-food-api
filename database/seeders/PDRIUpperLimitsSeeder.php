<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PDRIUpperLimitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        'age_from', 'age_to', 'age_type',
        
        'vitamin_a',
        'vitamin_d',
        'vitamin_e',
        'vitamin_niacin',
        'vitamin_pyridoxine',
        'folate',
        'vitamin_c',
        'iron',
        'zinc',
        'selenium',
        'iodine',
        'calcium',
        'magnesium',
        'phosphorus',
        'fluoride',
        */

        $data = [

            [
                0, 5, 'month',

                600, 
                25, 
                null, 
                null, 
                null, 
                null, 
                null, 
                40, 
                4, 
                45, 
                null, 
                1000, 
                null, 
                null, 
                0.7,
            ],

            [
                6, 11, 'month',
                
                600,
                25,
                null,
                null,
                null,
                null,
                null,
                40,
                5,
                60,
                null,
                1500,
                null,
                null,
                0.9,
            ],

            [
                1, 2, 'year',

                600,
                50,
                200,
                10,
                30,
                300,
                400,
                40,
                7,
                90,
                200,
                2500,
                65,
                3000,
                1.3,
            ],

            [
                3, 3, 'year',
                
                600,
                50,
                200,
                10,
                30,
                300,
                400,
                40,
                7,
                90,
                200,
                2500,
                65,
                3000,
                1.3,
            ],

            [
                4, 5, 'year',

                900,
                50,
                300,
                15,
                40,
                400,
                650,
                40,
                12,
                150,
                300,
                2500,
                110,
                3000,
                2.2,
            ],

            [
                6, 8, 'year',

                900,
                50,
                300,
                15,
                40,
                400,
                650,
                40,
                12,
                150,
                300,
                2500,
                110,
                3000,
                2.2,
            ],

            [
                9, 9, 'year',

                1700,
                50,
                600,
                20,
                60,
                600,
                1200,
                40,
                23,
                280,
                600,
                3000,
                350,
                4000,
                10.0,

              
            ],

            [
                10, 12, 'year',

                1700,
                50,
                600,
                20,
                60,
                600,
                1200,
                40,
                23,
                280,
                600,
                3000,
                350,
                4000,
                10.0,
            ],

            [
                13, 13, 'year',

                1700,
                50,
                600,
                20,
                60,
                600,
                1200,
                40,
                23,
                280,
                600,
                3000,
                350,
                4000,
                10.0,               
            ],

            [
                14, 15, 'year',

                2800,
                50,
                800,
                30,
                80,
                800,
                1800,
                45,
                34,
                400,
                900,
                3000,
                350,
                4000,
                10.0,
            ],

            [
                16, 18, 'year',

                2800,
                50,
                800,
                30,
                80,
                800,
                1800,
                45,
                34,
                400,
                900,
                3000,
                350,
                4000,
                10.0,
            ],

            [
                19, 29, 'year',

                3000,
                50,
                1000,
                35,
                100,
                1000,
                1000,
                45,
                45,
                400,
                1100,
                3000,
                350,
                4000,
                10.0,
            ],

            [
                30, 49, 'year',

                3000,
                50,
                1000,
                35,
                100,
                1000,
                1000,
                45,
                45,
                400,
                1100,
                3000,
                350,
                4000,
                10.0,
            ],

            [
                50, 59, 'year',

                3000,
                50,
                1000,
                35,
                100,
                1000,
                1000,
                45,
                45,
                400,
                1100,
                3000,
                350,
                4000,
                10.0,
            ],

            [
                60, 70, 'year',

                3000,
                50,
                1000,
                35,
                100,
                1000,
                1000,
                45,
                45,
                400,
                1100,
                3000,
                350,
                4000,
                10.0,
            ],

            [
                70, null, 'year',

                3000,
                50,
                1000,
                35,
                100,
                1000,
                1000,
                45,
                45,
                400,
                1100,
                2000,
                350,
                3000,
                10.0,
            ]

        ];


        foreach ($data as $row) 
        {
            DB::table('pdri_upper_limits')
                ->insert([
                    'age_from' => $row[0],
                    'age_to' => $row[1],
                    'age_type' => $row[2],
                    'vitamin_a' => $row[3],
                    'vitamin_d' => $row[4],
                    'vitamin_e' => $row[5],
                    'vitamin_niacin' => $row[6],
                    'vitamin_pyridoxine' => $row[7],
                    'folate' => $row[8],
                    'vitamin_c' => $row[9],
                    'iron' => $row[10],
                    'zinc' => $row[11],
                    'selenium' => $row[12],
                    'iodine' => $row[13],
                    'calcium' => $row[14],
                    'magnesium' => $row[15],
                    'phosphorus' => $row[16],
                    'fluoride' => $row[17],

                    'created_at' => now(),
                ]);
        }
    }
}
