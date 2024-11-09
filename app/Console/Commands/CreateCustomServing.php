<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomServing;
use App\Models\ServingUnit;
use App\Models\CustomServingsUnit;
use Str;

class CreateCustomServing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-custom-serving';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For creating new custom servings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $custom_serving_name = $this->ask("What's the name of the custom serving?");

        $serving_units = [];

        while (true) {
            $add_unit = $this->ask('Would you like to add a unit? (y/n)');
        
            if (strtolower($add_unit) !== 'y') {
                break; // Exit the loop if the user doesn't want to add more units
            }
        
            $unit_name = $this->ask('Unit name: ');
            $long_name = $this->ask('Long name (optional): ');
            $weight = $this->ask('Weight (eg. 100g): ');

            $value_and_unit = getValueAndUnit($weight);

            $serving_units[] = [
                'name' => $unit_name,
                'long_name' => $long_name,
                'weight' => $value_and_unit['value'],
                'weight_unit' => $value_and_unit['unit'],
            ];
    
        }

        $custom_serving = CustomServing::create([
            'name' => $custom_serving_name, 
            'slug' => Str::slug($custom_serving_name)
        ]);

        $custom_serving_units = [];
        foreach ($serving_units as $unit) {
            $serving_unit = ServingUnit::create($unit);
            $custom_serving_units[] = [
                'custom_servings_id' => $custom_serving->id,
                'serving_unit_id' => $serving_unit->id,
            ];
        }
        
        CustomServingsUnit::insert($custom_serving_units);

        $this->info('Custom serving created!');
    }
}
