<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReniUpperLimitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        'age_from', 'age_to',
        
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
                0, 5,

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
                6, 11,
                
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
                1, 2,

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
                3, null,
                
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
                4, 5,

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
                6, 8,

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
                9, null,

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
                10, 12,

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
                13, null,

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
                14, 15,

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
                16, 18,

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
                19, 29,

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
                30, 49,

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
                50, 59,

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
                60, 70,

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
                70, null, 

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
            DB::table('reni_upper_limits')
                ->insert([
                    'age_from' => $row[0],
                    'age_to' => $row[1],
                    'vitamin_a' => $row[2],
                    'vitamin_d' => $row[3],
                    'vitamin_e' => $row[4],
                    'vitamin_niacin' => $row[5],
                    'vitamin_pyridoxine' => $row[6],
                    'folate' => $row[7],
                    'vitamin_c' => $row[8],
                    'iron' => $row[9],
                    'zinc' => $row[10],
                    'selenium' => $row[11],
                    'iodine' => $row[12],
                    'calcium' => $row[13],
                    'magnesium' => $row[14],
                    'phosphorus' => $row[15],
                    'fluoride' => $row[16],

                    'created_at' => now(),
                ]);
        }
    }
}
