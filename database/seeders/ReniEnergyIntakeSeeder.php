<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReniEnergyIntakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        'age_from', 'age_to', 'age_type',

        'male_weight', 'female_weight',
        
        'male_energy_req_in_kcal', 'female_energy_req_in_kcal', 
        */

        $data = [
            // infants
            [
                0, 5, 'month',
                
                6.5, 6.0,

                620, 560
            ],

            [
                6, 11, 'month',
                
                9.0, 8.0,

                720, 630,
            ],

            // children
            [
                1, 2, 'year',

                12.0, 11.5,

                1000, 920
            ],

            [
                3, 5, 'year',
                
                17.5, 17.0,
                
                1350, 1260,
            ],

            [
                6, 9, 'year',

                23.0, 22.5,

                1600, 1470,
            ],

            [
                10, 12, 'year',

                33.0, 36.0,

                2060, 1980,
            ],

            [
                13, 15, 'year',
                
                48.5, 46.0,

                2700, 2170,
            ],

            [
                16, 18, 'year',

                59, 51.5,

                3010, 2280,
            ],

            // adults
            [
                19, 29, 'year',

                60.5, 52.5,

                2530, 1930,
            ],

            [
                30, 49, 'year',

                60.5, 52.5,

                2420, 1870,
            ],

            [
                50, 59, 'year',

                60.5, 52.5,

                2420, 1870,
            ],

            [
                60, 69, 'year',

                60.5, 52.5,

                2140, 1610,
            ],

            [
                70, null, 'year',
                
                60.5, 52.5,

                1960, 1540,
            ]
        ];


        foreach ($data as $row) 
        {
            DB::table('reni_energy_intake')
                ->insert([
                    'age_from' => $row[0],
                    'age_to' => $row[1],
                    'male_weight_in_kg' => $row[2],
                    'female_weight_in_kg' => $row[3],
                    'male_energy_req_in_kcal' => $row[4],
                    'female_energy_req_in_kcal' => $row[5],

                    'created_at' => now(),
                ]);
        }
    }
}
