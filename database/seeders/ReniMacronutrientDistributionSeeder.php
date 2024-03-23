<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReniMacronutrientDistributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* 
        'age_from', 'age_to',

        'protein_from', 'protein_to',

        'fat_from', 'fat_to',

        'carbs_from', 'carbs_to'
        */

        $data = [
            // infant
            [
                0,5,

                5, null,
                
                40, 60,

                35, 55,
            ],

            [
                6, 11,

                8, 15,

                30, 40,

                45, 62,
            ],

            // children
            [
                1, 2,

                6, 15,

                25, 35,

                50, 69,
            ],

            [
                3, 18,

                6, 15,

                15, 30,

                55, 79,
            ],

            // adults
            [
                19, null,

                10, 15,

                15, 30,

                55, 75,
            ]
        ];

        foreach ($data as $row) {
            DB::table('reni_macronutrient_distribution')
                ->insert([
                    'age_from' => $row[0], 
                    'age_to' => $row[1],

                    'protein_from' => $row[2], 
                    'protein_to' => $row[3],

                    'fat_from' => $row[4], 
                    'fat_to' => $row[5],

                    'carbs_from' => $row[6], 
                    'carbs_to' => $row[7],

                    'created_at' => now(),
                ]);
        }
    
    }


}
