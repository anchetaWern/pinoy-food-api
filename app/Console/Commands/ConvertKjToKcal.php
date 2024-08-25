<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Food;

class ConvertKjToKcal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-kj-to-kcal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert kJ to kcal';

    private $kj_to_kcal_conversion_factor = 4.184; 

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $foods_with_kj = Food::where('calories_unit', '=', 'kJ')
            ->orWhere('calories_unit', '=', 'kj')
            ->get();

        foreach ($foods_with_kj as $food) {

            $new_calories = $food->calories / $this->kj_to_kcal_conversion_factor;

            Food::where('id', $food->id)
                ->update([
                    'calories' => $new_calories,
                    'calories_unit' => 'kcal',
                ]);
        }

    }
}
