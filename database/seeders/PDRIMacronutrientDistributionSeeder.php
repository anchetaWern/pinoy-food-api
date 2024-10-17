<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PDRIMacronutrientDistributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* 
        'age_from', 'age_to', 'age_type',

        'protein_from', 'protein_to',

        'fat_from', 'fat_to',

        'carbs_from', 'carbs_to'
        */

        $data = [
            // infant
            [
                0, 5, 'month',

                5, null,
                
                40, 60,

                35, 55,
            ],

            [
                6, 11, 'month',

                8, 15,

                30, 40,

                45, 62,
            ],

            // children
            [
                1, 2, 'year',

                6, 15,

                25, 35,

                50, 69,
            ],

            [
                3, 18, 'year',

                6, 15,

                15, 30,

                55, 79,
            ],

            // adults
            [
                19, null, 'year',

                10, 15,

                15, 30,

                55, 75,
            ]
        ];

        foreach ($data as $row) {
            DB::table('pdri_macronutrient_distribution')
                ->insert([
                    'age_from' => $row[0], 
                    'age_to' => $row[1],
                    'age_type' => $row[2],

                    'protein_from' => $row[3], 
                    'protein_to' => $row[4],

                    'fat_from' => $row[5], 
                    'fat_to' => $row[6],

                    'carbs_from' => $row[7], 
                    'carbs_to' => $row[8],

                    'created_at' => now(),
                ]);
        }
    
    }


}
