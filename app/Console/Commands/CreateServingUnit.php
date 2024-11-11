<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServingUnit;

class CreateServingUnit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-serving-unit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create serving unit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask("Serving unit name: ");
        $long_name = $this->ask("Long name (optional): ");

        $weight_and_unit = $this->ask("Weight and unit (optional, eg. 100g): ");

        $value_and_unit = ['value' => null, 'unit' => null];
        if ($weight_and_unit) {
            $value_and_unit = getValueAndUnit($weight_and_unit);
        }

        ServingUnit::create([
            'name' => $name,
            'long_name' => $long_name,
            'weight' => $value_and_unit['value'],
            'weight_unit' => $value_and_unit['unit']
        ]);

        $this->info("Created serving unit!");
        
    }
}
