<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAONutrientContentClaimsCondition;

class FAONutrientContentClaimsConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'component' => 'energy',
                'claim' => 'low',
                'food_state' => 'solid',
                'condition' => '40kcal',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'energy',
                'claim' => 'low',
                'food_state' => 'liquid',
                'condition' => '20kcal',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'energy',
                'claim' => 'free',
                'food_state' => 'liquid',
                'condition' => '4kcal',
                'condition_type' => 'amount',
            ],

            [
                'component' => 'fat',
                'claim' => 'low',
                'food_state' => 'solid',
                'condition' => '3g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'fat',
                'claim' => 'low',
                'food_state' => 'liquid',
                'condition' => '1.5g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'fat',
                'claim' => 'free',
                'food_state' => 'solid',
                'condition' => '0.5g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'fat',
                'claim' => 'free',
                'food_state' => 'liquid',
                'condition' => '0.5g',
                'condition_type' => 'amount',
            ],

            [
                'component' => 'saturated fat',
                'claim' => 'low',
                'food_state' => 'solid',
                'condition' => '1.5g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'saturated fat',
                'claim' => 'low',
                'food_state' => 'liquid',
                'condition' => '0.75g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'saturated fat',
                'claim' => 'free',
                'food_state' => 'solid',
                'condition' => '0.1g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'saturated fat',
                'claim' => 'free',
                'food_state' => 'liquid',
                'condition' => '0.1g',
                'condition_type' => 'amount',
            ],


            [
                'component' => 'cholesterol',
                'claim' => 'low',
                'food_state' => 'solid',
                'condition' => '0.02g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'cholesterol',
                'claim' => 'low',
                'food_state' => 'liquid',
                'condition' => '0.01g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'cholesterol',
                'claim' => 'free',
                'food_state' => 'solid',
                'condition' => '0.005g',
                'condition_type' => 'amount', // note: has additional condition later
            ],
            [
                'component' => 'cholesterol',
                'claim' => 'free',
                'food_state' => 'liquid',
                'condition' => '0.005g',
                'condition_type' => 'amount',
            ],


            [
                'component' => 'sugars',
                'claim' => 'free',
                'food_state' => 'solid',
                'condition' => '0.5g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'sugars',
                'claim' => 'free',
                'food_state' => 'liquid',
                'condition' => '0.5g',
                'condition_type' => 'amount',
            ],


            [
                'component' => 'sodium',
                'claim' => 'low',
                'food_state' => 'solid',
                'condition' => '0.12g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'sodium',
                'claim' => 'low',
                'food_state' => 'liquid',
                'condition' => '0.12g',
                'condition_type' => 'amount',
            ],

            [
                'component' => 'sodium',
                'claim' => 'very low',
                'food_state' => 'solid',
                'condition' => '0.04g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'sodium',
                'claim' => 'very low',
                'food_state' => 'liquid',
                'condition' => '0.04g',
                'condition_type' => 'amount',
            ],

            [
                'component' => 'sodium',
                'claim' => 'free',
                'food_state' => 'solid',
                'condition' => '0.005g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'sodium',
                'claim' => 'free',
                'food_state' => 'liquid',
                'condition' => '0.005g',
                'condition_type' => 'amount',
            ],


            [
                'component' => 'protein',
                'claim' => 'source',
                'food_state' => 'solid',
                'condition' => '10',
                'condition_type' => 'percent',
            ],
            [
                'component' => 'protein',
                'claim' => 'source',
                'food_state' => 'liquid',
                'condition' => '5',
                'condition_type' => 'percent',
            ],
            [
                'component' => 'protein',
                'claim' => 'high',
                'food_state' => 'solid',
                'condition' => '20',
                'condition_type' => 'percent',
            ],
            [
                'component' => 'protein',
                'claim' => 'high',
                'food_state' => 'liquid',
                'condition' => '10',
                'condition_type' => 'percent',
            ],


            [
                'component' => 'vitamins and minerals',
                'claim' => 'source',
                'food_state' => 'solid',
                'condition' => '10',
                'condition_type' => 'percent',
            ],
            [
                'component' => 'vitamins and minerals',
                'claim' => 'source',
                'food_state' => 'liquid',
                'condition' => '5',
                'condition_type' => 'percent',
            ],
            [
                'component' => 'vitamins and minerals',
                'claim' => 'high',
                'food_state' => 'solid',
                'condition' => '20',
                'condition_type' => 'percent',
            ],
            [
                'component' => 'vitamins and minerals',
                'claim' => 'high',
                'food_state' => 'liquid',
                'condition' => '10',
                'condition_type' => 'percent',
            ],


            [
                'component' => 'dietary fiber',
                'claim' => 'source',
                'food_state' => 'solid',
                'condition' => '3g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'dietary fiber',
                'claim' => 'source',
                'food_state' => 'liquid',
                'condition' => '3g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'dietary fiber',
                'claim' => 'high',
                'food_state' => 'solid',
                'condition' => '6g',
                'condition_type' => 'amount',
            ],
            [
                'component' => 'dietary fiber',
                'claim' => 'high',
                'food_state' => 'liquid',
                'condition' => '6g',
                'condition_type' => 'amount',
            ],
        ];

        foreach ($data as $row) {
            FAONutrientContentClaimsCondition::create($row);
        }

        $saturated_fat_solid_low = FAONutrientContentClaimsCondition::where('component', 'saturated fat')
            ->where('claim', 'low')
            ->where('food_state', 'solid')
            ->first();
        
        $saturated_fat_liquid_low = FAONutrientContentClaimsCondition::where('component', 'saturated fat')
            ->where('claim', 'low')
            ->where('food_state', 'liquid')
            ->first();
        
        FAONutrientContentClaimsCondition::where('component', 'cholesterol')
            ->where('claim', 'free')
            ->where('food_state', 'solid')
            ->update([
                'additional_condition_id' => $saturated_fat_solid_low->id
            ]);
        
        FAONutrientContentClaimsCondition::where('component', 'cholesterol')
            ->where('claim', 'free')
            ->where('food_state', 'liquid')
            ->update([
                'additional_condition_id' => $saturated_fat_liquid_low->id
            ]);
    }
}
