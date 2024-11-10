<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Food;
use App\Models\FoodDensity;

class AssignFoodDensityToFood extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-food-density-to-food';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add food_density_id to food';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $food_slug = $this->ask("What's the food slug?");
        $food_density_id = $this->ask("What's the food density ID?");

        Food::where('description_slug', $food_slug)
            ->update([
                'food_density_id' => $food_density_id,
            ]);
        
        $this->info("Food density added!");
    }
}
