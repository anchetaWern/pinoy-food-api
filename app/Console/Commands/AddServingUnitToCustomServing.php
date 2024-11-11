<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomServing;
use App\Models\ServingUnit;
use App\Models\CustomServingsUnit;

class AddServingUnitToCustomServing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-serving-unit-to-custom-serving';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds serving unit to custom serving';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $custom_serving_slug = $this->ask("Custom serving slug: ");

        $serving_unit_name = $this->ask("Serving unit name: ");

        $custom_serving = CustomServing::where('slug', $custom_serving_slug)->first();

        $serving_unit = ServingUnit::where('name', 'LIKE', "%" . $serving_unit_name . "%")->first();
        
        if ($custom_serving && $serving_unit) {

            $exists = CustomServingsUnit::where('custom_servings_id', $custom_serving->id)
                ->where('serving_unit_id', $serving_unit->id)
                ->count();

            if ($exists) {
                $this->info("Already exists!");
            } else {
                CustomServingsUnit::create([
                    'custom_servings_id' => $custom_serving->id,
                    'serving_unit_id' => $serving_unit->id,
                ]);
    
                $this->info("Added " . $serving_unit_name . " to " . $custom_serving->name . "!");
            }
            
        }

        if (!$custom_serving) {
            $this->info("Can't find custom serving.");
        }

        if (!$serving_unit) {
            $this->info("Can't find serving unit.");
        }
    }
}
