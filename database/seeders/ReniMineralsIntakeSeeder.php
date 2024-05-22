<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReniMineralsIntakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        'age_from', 'age_to', 'age_type',

        'male_iron', 'female_iron',

        'male_zinc', 'female_zinc',
        
        'male_iodine', 'female_iodine',

        'male_calcium', 'female_calcium',
        
        'male_magnesium', 'female_magnesium',

        'male_phosphorus', 'female_phosphorus',

        'male_fluoride', 'female_fluoride',

        'sodium',
        'chloride',
        'potassium',
        */

        $data = [
            [
                0, 5, 'month',
                
                0.4, 0.4, 
                
                2.0, 2.0, 
                
                7, 6, 
                
                90, 90, 
                
                200, 200, 
                
                26, 26, 
                
                90, 90, 
                
                0.01, 0.01, 
                
                120, 
                180, 
                500,
            ],

            [
                6, 11, 'month',
                
                10, 9, 
                
                4.2, 3.7, 
                
                10, 9, 
                
                90, 90, 
                
                400, 400, 
                
                50, 50, 
                
                275, 275, 
                
                0.5, 0.4, 
                
                200, 
                300, 
                700,
            ],

            [
                1, 2, 'year',

                8, 8, 
                
                4.1, 4.0, 
                
                17, 16, 
                
                90, 90, 
                
                500, 500, 
                
                60, 60, 
                
                460, 460, 
                
                0.6, 0.6, 
                
                225, 
                350, 
                1000,
            ],

            [
                3, 5, 'year',
                
                9, 9, 
                
                5.0, 4.8, 
                
                20, 20, 
                
                90, 90, 
                
                550, 550, 
                
                70, 70, 
                
                500, 500, 
                
                0.9, 0.9, 
                
                300, 
                500, 
                1400,
            ],

            [
                6, 9, 'year',

                10, 9, 
                
                5.1, 5.0, 
                
                20, 19, 
                
                120, 120, 
                
                700, 700, 
                
                90, 90, 
                
                500, 500, 
                
                1.2, 1.1, 
                
                400, 
                600, 
                1600,
            ],

            [
                10, 12, 'year',

                12, 20, 
                
                6.6, 6.1, 
                
                21, 23, 
                
                120, 120, 
                
                1000, 1000, 
                
                150, 160, 
                
                1250, 1250, 
                
                1.7, 1.8, 
                
                500, 
                750, 
                2000,
            ],

            [
                13, 15, 'year',

                19, 28, 
                
                9.2, 7.4, 
                
                30, 29, 
                
                150, 150, 
                
                1000, 1000, 
                
                220, 210, 
                
                1250, 1250, 
                
                2.4, 2.3, 
                
                500, 
                750, 
                2000,
            ],

            [
                16, 18, 'year',

                14, 28, 
                
                9.0, 7.2, 
                
                37, 32, 
                
                150, 150, 
                
                1000, 1000, 
                
                265, 230, 
                
                1250, 1250, 
                
                3.0, 2.6, 
                
                500, 
                750, 
                2000,
            ],

            [
                19, 29, 'year',

                12, 28, 
                
                6.5, 4.6, 
                
                38, 33, 
                
                150, 150, 
                
                750, 750, 
                
                240, 210, 
                
                700, 700, 
                
                3.0, 2.6, 
                
                500, 
                750, 
                2000,
            ],

            [
                30, 49, 'year',

                12, 28, 
                
                6.5, 4.6, 
                
                38, 33, 
                
                150, 150, 
                
                750, 750, 
                
                240, 210, 
                
                700, 700, 
                
                3.0, 2.6, 
                
                500,
                750, 
                2000,
            ],

            [
                50, 59, 'year',

                12, 10, 
                
                6.5, 4.6, 
                
                38, 33, 
                
                150, 150, 
                
                750, 800, 
                
                240, 210, 
                
                700, 700, 
                
                3.0, 2.6, 
                
                500, 
                750, 
                2000,
            ],

            [
                60, 69, 'year',

                12, 10, 
                
                6.5, 4.6, 
                
                38, 33, 
                
                150, 150, 
                
                800, 800, 
                
                240, 210, 
                
                700, 700, 
                
                3.0, 2.6, 
                
                500, 
                750, 
                2000,
            ],

            [
                70, null, 'year', 

                12, 10, 
                
                6.5, 4.6, 
                
                38, 33, 
                
                150, 150, 
                
                800, 800, 
                
                240, 210, 
                
                700, 700, 
                
                3.0, 2.6, 
                
                500, 
                750, 
                2000,
            ]
        ];

        foreach ($data as $row) {
            DB::table('reni_minerals_intake')
                ->insert([
                    'age_from' => $row[0], 
                    'age_to' => $row[1],
                    'age_type' => $row[2],

                    'male_iron' => $row[3], 
                    'female_iron' => $row[4],
            
                    'male_zinc' => $row[5], 
                    'female_zinc' => $row[6],

                    'male_selenium' => $row[7],
                    'female_selenium' => $row[8], 
                    
                    'male_iodine' => $row[9], 
                    'female_iodine' => $row[10],
            
                    'male_calcium' => $row[11], 
                    'female_calcium' => $row[12],
                    
                    'male_magnesium' => $row[13], 
                    'female_magnesium' => $row[14],
            
                    'male_phosphorus' => $row[15], 
                    'female_phosphorus' => $row[16],
            
                    'male_fluoride' => $row[17], 
                    'female_fluoride' => $row[18],
            
                    'sodium' => $row[19],
                    'chloride' => $row[20],
                    'potassium' => $row[21],

                    'created_at' => now(),
                ]);
        }
    }
}
