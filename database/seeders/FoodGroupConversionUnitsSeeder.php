<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FoodGroupConversionUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // food_groups
        $dry_foods_id = DB::table('food_groups')
            ->insertGetId([
                'description' => 'dry',
                'purpose' => 'unit_conversion',
            ]);
        $liquid_foods_id =  DB::table('food_groups')
            ->insertGetId([
                'description' => 'liquid',
                'purpose' => 'unit_conversion',
            ]);
        
        $semi_solid_foods_id = DB::table('food_groups')
            ->insertGetId([
                'description' => 'semi-solid',
                'purpose' => 'unit_conversion',
            ]);

        $solid_foods_id = DB::table('food_groups')
            ->insertGetId([
                'description' => 'solid',
                'purpose' => 'unit_conversion',
            ]);

        $whole_foods_id = DB::table('food_groups')
            ->insertGetId([
                'description' => 'whole food',
                'purpose' => 'unit_conversion',
            ]);
        
        $meat_and_seafood_id = DB::table('food_groups')
            ->insertGetId([
                'description' => 'meat and seafood',
                'purpose' => 'unit_conversion',
            ]);

        $misc_id = DB::table('food_groups')
            ->insertGetId([
                'description' => 'miscellaneous',
                'purpose' => 'unit_conversion',
            ]);

        // conversion units
        $ml_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'mL',
                'unit_long' => 'Milliliter',
            ]);

        $liter_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'L',
                'unit_long' => 'Liter',
            ]);

        $tsp_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'tsp',
                'unit_long' => 'Teaspoon',
            ]);

        $tbsp_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'tbsp',
                'unit_long' => 'Tablespoon',
            ],);

        $fluid_oz_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'fl oz',
                'unit_long' => 'Fluid Ounce',
            ]);

        $cup_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'c',
                'unit_long' => 'Cup',
            ]);

        $pint_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'pt',
                'unit_long' => 'Pint',
            ]);

        $pint_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'qt',
                'unit_long' => 'Quart',
            ]);
    
        $pint_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'gal',
                'unit_long' => 'Gallon',
            ]);

        $mg_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'mg',
                'unit_long' => 'Milligram',
            ]);

        $gram_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'g',
                'unit_long' => 'Gram',
            ]);
    
        $kg_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'kg',
                'unit_long' => 'Kilogram',
            ]);

        $lb_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'lb',
                'unit_long' => 'Pound',
            ]);

        $oz_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'oz',
                'unit_long' => 'Ounce',
            ]);

        
        $pinch_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'pinch',
                'unit_long' => null,
            ]);

        $dash_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'dash',
                'unit_long' => null,
            ],);

        $slice_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'slice',
                'unit_long' => null,
            ]);

        $piece_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'piece',
                'unit_long' => null,
            ]);
    
        $clove_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'clove',
                'unit_long' => null,
            ]);

        $stalk_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'stalk',
                'unit_long' => null,
            ]);

        $head_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'head',
                'unit_long' => null,
            ]);

        $sprig_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'sprig',
                'unit_long' => null,
            ]);

        $bunch_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'bunch',
                'unit_long' => null,
            ]);

        $each_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'each',
                'unit_long' => null,
            ]);

        $handful_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'handful',
                'unit_long' => null,
            ]);

        $knob_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'knob',
                'unit_long' => null,
            ]);

        $can_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'can',
                'unit_long' => null,
            ]);


        $fillet_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'fillet',
                'unit_long' => null,
            ]);

        $rib_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'rib',
                'unit_long' => null,
            ]);

        $stick_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'stick',
                'unit_long' => null,
            ]);

        $leg_id = DB::table('conversion_units')
            ->insertGetId([
                'unit' => 'leg',
                'unit_long' => null,
            ]);
      

        // food_group_conversion_units
        DB::table('food_group_conversion_units')
            ->insert([
                // dry ingredients
                [
                    'food_group_id' => $dry_foods_id,
                    'conversion_unit_id' => $tsp_id,
                ],
                [
                    'food_group_id' => $dry_foods_id,
                    'conversion_unit_id' => $cup_id,
                ],
                [
                    'food_group_id' => $dry_foods_id,
                    'conversion_unit_id' => $gram_id,
                ],

                // liquids
                [
                    'food_group_id' => $liquid_foods_id,
                    'conversion_unit_id' => $tsp_id,
                ],
                [
                    'food_group_id' => $liquid_foods_id,
                    'conversion_unit_id' => $fluid_oz_id,
                ],
                [
                    'food_group_id' => $liquid_foods_id,
                    'conversion_unit_id' => $ml_id,
                ],

                // semi-solid
                [
                    'food_group_id' => $semi_solid_foods_id,
                    'conversion_unit_id' => $tsp_id,
                ],
                [
                    'food_group_id' => $semi_solid_foods_id,
                    'conversion_unit_id' => $cup_id,
                ],

                // solids
                [
                    'food_group_id' => $solid_foods_id,
                    'conversion_unit_id' => $cup_id,
                ],
                [
                    'food_group_id' => $solid_foods_id,
                    'conversion_unit_id' => $gram_id,
                ],

                // whole foods
                [
                    'food_group_id' => $whole_foods_id,
                    'conversion_unit_id' => $each_id,
                ],
                [
                    'food_group_id' => $whole_foods_id,
                    'conversion_unit_id' => $bunch_id,
                ],

                // meat and seafoods
                [
                    'food_group_id' => $meat_and_seafood_id,
                    'conversion_unit_id' => $lb_id,
                ],
                [
                    'food_group_id' => $meat_and_seafood_id,
                    'conversion_unit_id' => $oz_id,
                ],
                [
                    'food_group_id' => $meat_and_seafood_id,
                    'conversion_unit_id' => $gram_id,
                ],
                [
                    'food_group_id' => $meat_and_seafood_id,
                    'conversion_unit_id' => $kg_id,
                ],

                // misc
                [
                    'food_group_id' => $misc_id,
                    'conversion_unit_id' => $pinch_id,
                ],
                [
                    'food_group_id' => $misc_id,
                    'conversion_unit_id' => $dash_id,
                ],
                [
                    'food_group_id' => $misc_id,
                    'conversion_unit_id' => $stick_id,
                ],
                [
                    'food_group_id' => $misc_id,
                    'conversion_unit_id' => $handful_id,
                ],
                
            ]);
        
    }
}
