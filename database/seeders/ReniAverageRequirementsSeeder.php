<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReniAverageRequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                0, 5, 'month',
                
                7, 7, 
                
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                5.5, 5.1, 
                null, null, 
                null, null, 
                null, null,
            ],

            [
                6, 11, 'month',
                
                14, 13, 
                190, 190, 
                0.3, 0.3, 
                0.3, 0.3, 
                4, 3, 
                null, null, 
                null, null, 
                null, null, 
                null, null, 
                
                8.4, 7.2, 
                2.8, 2.5, 
                8.2, 7.3, 
                null, null, 
                null, null, 
                null, null,
            ],

            [
                1, 2, 'year',

                15, 14, 
                200, 200, 
                0.4, 0.4, 
                0.4, 0.4, 
                5, 5, 
                0.4, 0.5, 
                0.8, 0.9, 
                120, 120, 
                12, 11, 
                6.4, 7.0, 
                2.8, 2.6, 
                13.6, 13.0, 
                65, 65, 
                440, 440, 
                380, 380,
            ],

            [
                3, 5, 'year',
                
                18, 17, 
                226, 214, 
                0.5, 0.4, 
                0.5, 0.4, 
                5, 5, 
                0.5, 0.5, 
                0.9, 1.0, 
                160, 160, 
                17, 17, 
                7.5, 7.4, 
                3.3, 3.2, 
                16.1, 15.6, 
                65, 65, 
                440, 440, 
                405, 405,
            ],

            [
                6, 9, 'year',

                24, 24, 
                278, 264, 
                0.6, 0.5, 
                0.6, 0.5, 
                7, 7, 
                0.6, 0.7, 
                1.1, 1.2, 
                250, 250, 
                23, 22, 
                8.6, 7.8, 
                3.4, 3.4, 
                15.6, 15.3, 
                73, 73, 
                440, 440, 
                405, 405,
            ],

            [
                10, 12, 'year',

                35, 38, 
                364, 375, 
                0.7, 0.8, 
                0.8, 0.8, 
                9, 10, 
                0.8, 1.0, 
                1.5, 1.7, 
                250, 250, 
                33, 36, 
                10.2, 16.5, 
                4.4, 4.1, 
                16.5, 18.0, 
                73, 73, 
                440, 440, 
                1055, 1055,
            ],

            [
                13, 15, 'year',

                50, 46, 
                483, 392, 
                1.0, 0.8, 
                1.1, 0.8, 
                12, 10, 
                1.1, 1.0, 
                1.9, 1.8, 
                330, 330, 
                48, 45, 
                18.1, 16.5, 
                6.1, 4.9, 
                24.3, 23.0, 
                95, 95, 
                440, 440, 
                1055, 1055,
            ],

            [
                16, 18, 'year',

                59, 49, 
                563, 427, 
                1.1, 0.9, 
                1.2, 0.9, 
                14, 11, 
                1.2, 1.1, 
                2.3, 2.0, 
                330, 330, 
                58, 51, 
                12.1, 16.2, 
                6.0, 4.8, 
                29.5, 25.8, 
                95, 95, 
                440, 440, 
                1055, 1055,
            ],

            [
                19, 29, 'year',

                57, 49, 
                499, 433, 
                1.0, 0.9, 
                1.1, 0.9, 
                12, 11, 
                1.1, 1.1, 
                2.0, 2.0, 
                320, 320, 
                60, 52, 
                10.4, 26.3, 
                4.4, 3.1, 
                30.3, 26.3, 
                95, 95, 
                600, 600, 
                580, 580,
            ],

            [
                30, 49, 'year',

                57, 49, 
                499, 433, 
                1.0, 0.9, 
                1.1, 0.9, 
                12, 11, 
                1.1, 1.1, 
                2.0, 2.0, 
                320, 320, 
                60, 52, 
                10.4, 26.3, 
                4.4, 3.1, 
                30.3, 26.3, 
                95, 95, 
                600, 600, 
                580, 580,
            ],

            [
                50, 59, 'year',

                57, 49, 
                499, 433, 
                1.0, 0.9, 
                1.1, 0.9, 
                12, 11, 
                1.4, 1.3, 
                2.0, 2.0, 
                320, 320, 
                60, 52, 
                10.4, 8.6, 
                4.4, 3.1, 
                30.3, 26.3, 
                95, 95, 
                600, 600, 
                580, 580,
            ],

            [
                60, 69, 'year',

                57, 49, 
                499, 433, 
                1.0, 0.9, 
                1.1, 0.9, 
                12, 11, 
                1.4, 1.3, 
                2.0, 2.0, 
                320, 320, 
                60, 52, 
                10.4, 8.6, 
                4.4, 3.1, 
                30.3, 26.3, 
                95, 95, 
                600, 600, 
                580, 580,
            ],

            [
                70, null, 'year', 

                57, 49, 
                499, 433, 
                1.0, 0.9, 
                1.1, 0.9, 
                12, 11, 
                1.4, 1.3, 
                2.0, 2.0, 
                320, 320, 
                60, 52, 
                10.4, 8.6, 
                4.4, 3.1, 
                30.3, 26.3, 
                95, 95, 
                600, 600, 
                580, 580,
            ]

        ];

        foreach ($data as $row) {
            DB::table('reni_average_requirements')
                ->insert([
                    'age_from' => $row[0],
                    'age_to' => $row[1],
                    
                    'male_protein' => $row[2],
                    'female_protein' => $row[3],
                    
                    'male_vitamin_a' => $row[4],
                    'femaale_vitamin_a' => $row[5],
            
                    'male_thiamin' => $row[5],
                    'female_thiamin' => $row[6],
            
                    'male_riboflavin' => $row[7],
                    'female_riboflavin' => $row[8],
            
                    'male_niacin' => $row[9],
                    'female_niacin' => $row[10],
            
                    'male_pyridoxine' => $row[11],
                    'female_pyridoxine' => $row[12],
            
                    'male_cobalamin' => $row[13],
                    'female_cobalamin' => $row[14],
            
                    'male_folate' => $row[15],
                    'female_folate' => $row[16],
            
                    'male_vitamin_c' => $row[17],
                    'female_vitamin_c' => $row[18],
            
                    'male_iron' => $row[19],
                    'female_iron' => $row[20],
            
                    'male_zinc' => $row[21],
                    'female_zinc' => $row[22],
            
                    'male_selenium' => $row[23],
                    'female_selenium' => $row[23],
            
                    'male_iodine' => $row[24],
                    'female_iodine' => $row[25],
                    
                    'male_calcium' => $row[26],
                    'female_calcium' => $row[27],
            
                    'male_phosphorus' => $row[28],
                    'female_phosphorus' => $row[29],

                    'created_at' => now(),
                ]);
        }
    }
}
