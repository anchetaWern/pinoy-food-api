<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use avadim\FastExcelReader\Excel;
use App\Models\FoodDensity;

class AddFoodDensities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'food-densities:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add food density values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = storage_path('app/data/food-density/food-density.xlsx');
        $excel = Excel::open($file);

        $result =  $excel->selectSheet('Density DB')->readRows(true);

        $processed_result = collect($result)->values()->toArray();

        $density_data = [];
        foreach ($processed_result as $row) {
            if (isset($row['Food name and description']) && isset($row['Density in g/ml (including mass and bulk density)']) && !empty($row['Food name and description']) && !empty($row['Density in g/ml (including mass and bulk density)'])) {
                
                $density = $row['Density in g/ml (including mass and bulk density)'];
                if (!is_numeric($density)) {
                    $density_r = explode('-', $density);
                    $density = $density_r[0];
                }

                $density_data[] = [
                    'description' => $row['Food name and description'],
                    'density' => $density,
                ];
            }
        }

        FoodDensity::insert($density_data);

    }
}
