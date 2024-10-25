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
        age_from, age_to,
        age_type,

        male_weight_in_kg, female_weight_in_kg,
        
        male_calcium, female_calcium,
        
        male_iron, female_iron,
        
        male_iodine, female_iodine,
        
        male_magnesium, female_magnesium,
        
        male_phosphorus, female_phosphorus,
        
        male_zinc, female_zinc,
        
        male_selenium, female_selenium,
        
        male_fluoride, female_fluoride,
        
        male_manganese, female_manganese, 
        */
        $data = [
            [
                0, 5,
                'month',

                6, 6,
                
                200, 200,
                0.38, 0.38,
                90, 90,

                26, 26,
                90, 90,
                1.4, 1.4,
                
                6, 6,
                0.01, 0.01,
                0.003, 0.0003,
            ],

            [

                6, 11, 
                'month',

                9, 9,

                400, 400,
                1.0, 1.0,
                90, 90,
                
                54, 54,
                275, 275,
                4.2, 4.2,

                10, 10,
                0.5, 0.5,
                0.6, 0.6,
                
            ],

            [

                1, 3, 
                'year',

                13, 13,
               
                500, 500,
                8, 8,
                90, 90,

                65, 65,
                460, 460,
                4.5, 4.5,

                18, 18,
                0.7, 0.7,
                1.2, 1.2,
                
            ],


            [
                4, 6,
                'year',

                19, 19,
                
                550, 550,
                9, 9,
                90, 90,
            
                76, 76,
                500, 500,
                5.4, 5.4,

                22, 22, 
                1.0, 1.0,
                1.5, 1.5,
            ],

            [
                7, 9,
                'year',

                24, 24,
              
                700, 700,
                11, 11,
                120, 120,

                100, 100,
                500, 500,
                5.4, 5.4,

                20, 20,
                1.2, 1.2,
                1.7, 1.7,
            ],

            [
                10, 12,
                'year',

                34, 35,
               
                1000, 1000,
                13, 19,
                120, 120,

                155, 160, 
                1250, 1250,
                6.8, 6.0,

                21, 21,
                1.7, 1.8,
                1.9, 1.6,

            ],

            [
                13, 15,
                'year',
               
                50, 49,
                
                1000, 1000,
                20, 21,
                150, 150,
            
                225, 220, 
                1250, 1250,
                9.0, 7.9,

                31, 31,
                2.5, 2.5,
                2.2, 1.6,
            ],

            [
                16, 18,
                'year',
                
                58, 50,
                
                1000, 1000,
                14, 27,
                150, 150,

                260, 240,
                1250, 1250,
                8.9, 7.0,

                36, 36,
                2.9, 2.5,
                2.2, 1.6,
            ],

            [
                19, 29,
                'year',
                
                59, 51,
               
                750, 750,
                12, 27, 
                150, 150,
                
                235, 205,
                700, 700,
                6.4, 4.5,

                31, 31,
                3.0, 2.5,
                2.3, 1.8,

            ],

            [
                30, 49,
                'year',
                
                59, 51,
                
                750, 750,
                12, 27,
                150, 150,

                235, 205,
                700, 700,
                6.4, 4.5,

                31, 31,
                3.0, 2.5,
                2.3, 1.8,
            ],

            [
                50, 64,
                'year',
                
                59, 51,
           
                750, 800,
                12, 27,
                150, 150,

                235, 205,
                700, 700,
                6.4, 4.5,

                31, 31,
                3.0, 2.5,
                2.3, 1.8,
            ],


            [
                65, null,
                'year',
                
                59, 51,

                800, 800,
                12, 10,
                150, 150,

                235, 205,
                700, 700,
                6.4, 4.5,

                31, 31,
                3.0, 2.5,
                2.3, 1.8,
            ],
            

        ];


        foreach ($data as $item) 
        {
            DB::table('reni_minerals_intake')
                ->insert([
                    'age_from' => $item[0], 
                    'age_to' => $item[1],
                    'age_type' => $item[2],

                    'male_weight_in_kg' => $item[3], 
                    'female_weight_in_kg' => $item[4],
                    
                    'male_calcium' => $item[5], 
                    'female_calcium' => $item[6],
                    
                    'male_iron' => $item[7], 
                    'female_iron' => $item[8],
                    
                    'male_iodine' => $item[9], 
                    'female_iodine' => $item[10],
                    
                    'male_magnesium' => $item[11], 
                    'female_magnesium' => $item[12],
                    
                    'male_phosphorus' => $item[13], 
                    'female_phosphorus' => $item[14],
                    
                    'male_zinc' => $item[15], 
                    'female_zinc' => $item[16],
                    
                    'male_selenium' => $item[17], 
                    'female_selenium' => $item[18],
                    
                    'male_fluoride' => $item[19], 
                    'female_fluoride' => $item[20],
                    
                    'male_manganese' => $item[21], 
                    'female_manganese' => $item[22], 

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
    }
}
