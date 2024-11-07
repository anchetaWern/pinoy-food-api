<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use League\Csv\Reader;
use League\Csv\Statement;

class FoodDensitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = storage_path('app/data/food-density/density.csv');
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0); 
        $csv->setEscape('');
        
      
        $stmt = Statement::create();
        
        $records = $stmt->process($csv);
       
        foreach ($records as $record) {
            DB::table('food_densities')
                ->insert([
                    'description' => $record['Food'],
                    'density' => $record['Density'],
                ]);
        }
    }
}
