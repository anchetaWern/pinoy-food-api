<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomServing;
use App\Models\ServingUnit;
use App\Models\CustomServingsUnit;

class AddServingUnitsToCustomServing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-serving-units-to-custom-serving';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add serving units to a custom serving';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $custom_serving_slug = $this->ask('Custom serving slug: ');
        
        $serving_unit_ids = $this->ask("Serving unit IDs (comma-separated): ");

        $serving_unit_ids_arr = explode(',', $serving_unit_ids);

        $custom_serving = CustomServing::where('slug', $custom_serving_slug)->first();

        foreach ($serving_unit_ids_arr as $serving_unit_id) {

            CustomServingsUnit::create([
                'serving_unit_id' => $serving_unit_id,
                'custom_servings_id' => $custom_serving->id, 
            ]);
        }

        $this->info('Added serving units to custom serving!');

    }
}
