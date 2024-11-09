<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Food;
use App\Models\CustomServing;

class AddCustomServingToFood extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-custom-serving-to-food';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds custom serving to food';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $food_slug = $this->ask("What's the food slug?");

        $custom_serving_slug = $this->ask("What's the custom serving slug?");

        $custom_serving = CustomServing::where('slug', $custom_serving_slug)->first();

        Food::where('description_slug', $food_slug)
            ->update([
                'custom_servings_id' => $custom_serving->id,
            ]);
        
        $this->info('Added custom serving to food!');
    }
}
