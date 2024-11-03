<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;

class CustomServingsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $packaged_snack_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Packaged snacks',
                'slug' => Str::slug('Packaged snacks')
            ]);

        $bread_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Bread',
                'slug' => Str::slug('Bread')
            ]);

        $grains_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Grains and legumes',
                'slug' => Str::slug('Grains and legumes')
            ]);

        $oils_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Oils and fats',
                'slug' => Str::slug('Oils and fats')
            ]);
        
        $sauces_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Sauces and marinades',
                'slug' => Str::slug('Sauces and marinades')
            ]);
        $spices_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Spices and seasonings',
                'slug' => Str::slug('Spices and seasonings')
            ]);
        $dried_fruits_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Dried fruits and nuts',
                'slug' => Str::slug('Dried fruits and nuts')
            ]);
        $powders_and_granules_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Powders and granules',
                'slug' => Str::slug('Powders and granules')
            ]);
        $ready_to_eat_meal_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Ready-to-eat meals',
                'slug' => Str::slug('Ready-to-eat meals')
            ]);
        $homemade_meal_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Homemade meals',
                'slug' => Str::slug('Homemade meals')
            ]);

        $condiments_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Condiments',
                'slug' => Str::slug('Condiments')
            ]);
        $beverages_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Beverages',
                'slug' => Str::slug('Beverages')
            ]);
        $frozen_foods_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Frozen foods',
                'slug' => Str::slug('Frozen foods')
            ]);
        $meat_fish_poultry_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Meat, fish, poultry',
                'slug' => Str::slug('Meat, fish, poultry')
            ]);
        $eggs_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Eggs',
                'slug' => Str::slug('Eggs')
            ]);
        $fruits_and_veggies_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Fruits and vegetables',
                'slug' => Str::slug('Fruits and vegetables')
            ]);
     
        $canned_goods_id = DB::table('custom_servings_categories')
            ->insertGetId([
                'name' => 'Canned goods',
                'slug' => Str::slug('Canned goods')
            ]);
            
        // seed units
        $ml_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'mL',
                'long_name' => 'Milliliter',
            ]);

        $liter_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'L',
                'long_name' => 'Liter',
            ]);

        $fluid_oz_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'fl oz',
                'long_name' => 'Fluid Ounce',
            ]);

        $mg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'mg',
                'long_name' => 'Milligram',
            ]);

        $gram_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'g',
                'long_name' => 'Gram',
            ]);
    
        $kg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'kg',
                'long_name' => 'Kilogram',
            ]);

        $cavan_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'cavan', // 50 kg
            ]);
        $half_cavan_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'half cavan', // 25 kg
            ]);

        $lb_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'lb',
                'long_name' => 'Pound',
            ]);

        $oz_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'oz',
                'long_name' => 'Ounce',
            ]);


        $tsp_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'tsp',
                'long_name' => 'Teaspoon',
            ]);

        $tbsp_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'tbsp',
                'long_name' => 'Tablespoon',
            ]);

        $jar_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'jar',
            ]);
        $pouch_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'pouch',
            ]);
        $dip_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'dip',
            ]);
        $packet_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'packet',
            ]);
        $bottle_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'bottle',
            ]);
        $bag_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'bag',
            ]);
        $tub_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'tub',
            ]);
        $pitcher_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'pitcher',
            ]);
        $container_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'container',
            ]);
        $small_plate_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'small plate',
            ]);
        $medium_plate_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'medium plate',
            ]);
        $large_plate_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'large plate',
            ]);   
        $saucer_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'saucer',
            ]);    
        $pewee_egg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'pewee egg',
                'weight' => 41,
                'weight_unit' => 'g',
            ]);
        $extra_small_egg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'extra small egg',
                'weight' => 45,
                'weight_unit' => 'g',
            ]);
        $small_egg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'small egg',
                'weight' => 51,
                'weight_unit' => 'g',
            ]);
        $medium_egg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'medium egg',
                'weight' => 56,
                'weight_unit' => 'g',
            ]);
        $large_egg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'large egg',
                'weight' => 61,
                'weight_unit' => 'g',
            ]);
        $extra_large_egg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'extra large egg',
                'weight' => 66,
                'weight_unit' => 'g',
            ]);
        $jumbo_egg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'jumbo egg',
                'weight' => 71,
                'weight_unit' => 'g',
            ]);

        $small_cup_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'small cup',
            ]);
        $medium_cup_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'medium cup',
            ]);
        $large_cup_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'large cup',
            ]);
        $mug_id = DB::table('serving_units') // same as large cup
            ->insertGetId([
                'name' => 'mug',
            ]);
        $shot_id = DB::table('serving_units') 
            ->insertGetId([
                'name' => 'shot',
            ]);

        $small_bowl_id = DB::table('serving_units') 
            ->insertGetId([
                'name' => 'small bowl',
            ]);
        $medium_bowl_id = DB::table('serving_units') 
            ->insertGetId([
                'name' => 'medium bowl',
            ]);
        $large_bowl_id = DB::table('serving_units') 
            ->insertGetId([
                'name' => 'large bowl',
            ]);

        $glass_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'glass',
            ]);
        $sprinkle_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'sprinkle',
            ]);
        $loaf_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'loaf',
            ]);

        $pint_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'pt',
                'long_name' => 'Pint',
            ]);

        $quart_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'qt',
                'long_name' => 'Quart',
            ]);
    
        $gallon_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'gal',
                'long_name' => 'Gallon',
            ]);
        
        $pinch_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'pinch',
                'long_name' => null,
            ]);

        $dash_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'dash',
                'long_name' => null,
            ],);

        $slice_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'slice',
                'long_name' => null,
            ]);

        $piece_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'piece',
                'long_name' => null,
            ]);
    
        $clove_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'clove',
                'long_name' => null,
            ]);

        $stalk_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'stalk',
                'long_name' => null,
            ]);

        $head_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'head',
                'long_name' => null,
            ]);

        $sprig_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'sprig',
                'long_name' => null,
            ]);

        $bunch_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'bunch',
                'long_name' => null,
            ]);

        $each_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'each',
                'long_name' => null,
            ]);

        $handful_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'handful',
                'long_name' => null,
            ]);
        $pack_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'pack',
            ]);

        $knob_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'knob',
                'long_name' => null,
            ]);

        $can_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'can',
                'long_name' => null,
            ]);


        $fillet_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'fillet',
                'long_name' => null,
            ]);

        $rib_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'rib',
                'long_name' => null,
            ]);

        $stick_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'stick',
                'long_name' => null,
            ]);

        $leg_id = DB::table('serving_units')
            ->insertGetId([
                'name' => 'leg',
                'long_name' => null,
            ]);

        // todo: seed custom_servings_category_units
        $custom_serving_units = [
            [
                "custom_servings_category_id" => $packaged_snack_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $packaged_snack_id,
                "serving_unit_id" => $mg_id,
            ],
            [
                "custom_servings_category_id" => $packaged_snack_id,
                "serving_unit_id" => $oz_id,
            ],
            [
                "custom_servings_category_id" => $packaged_snack_id,
                "serving_unit_id" => $bag_id,
            ],
            [
                "custom_servings_category_id" => $packaged_snack_id,
                "serving_unit_id" => $pack_id,
            ],


            [
                "custom_servings_category_id" => $bread_id,
                "serving_unit_id" => $loaf_id,
            ],
            [
                "custom_servings_category_id" => $bread_id,
                "serving_unit_id" => $slice_id,
            ],
            [
                "custom_servings_category_id" => $bread_id,
                "serving_unit_id" => $mg_id,
            ],
            [
                "custom_servings_category_id" => $bread_id,
                "serving_unit_id" => $oz_id,
            ],
            
            
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $small_bowl_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $medium_bowl_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $large_bowl_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $small_cup_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $medium_cup_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $large_cup_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $lb_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $kg_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $cavan_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $half_cavan_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $mg_id,
            ],
            [
                "custom_servings_category_id" => $grains_id,
                "serving_unit_id" => $mg_id,
            ],


            [
                "custom_servings_category_id" => $oils_id,
                "serving_unit_id" => $tbsp_id,
            ],
            [
                "custom_servings_category_id" => $oils_id,
                "serving_unit_id" => $tsp_id,
            ],
            [
                "custom_servings_category_id" => $oils_id,
                "serving_unit_id" => $ml_id,
            ],
            [
                "custom_servings_category_id" => $oils_id,
                "serving_unit_id" => $fluid_oz_id,
            ],
        
            [
                "custom_servings_category_id" => $sauces_id,
                "serving_unit_id" => $small_cup_id,
            ],
            [
                "custom_servings_category_id" => $sauces_id,
                "serving_unit_id" => $medium_cup_id,
            ],
            [
                "custom_servings_category_id" => $sauces_id,
                "serving_unit_id" => $large_cup_id,
            ],
            [
                "custom_servings_category_id" => $sauces_id,
                "serving_unit_id" => $tbsp_id,
            ],
            [
                "custom_servings_category_id" => $sauces_id,
                "serving_unit_id" => $tsp_id,
            ],
         
            [
                "custom_servings_category_id" => $sauces_id,
                "serving_unit_id" => $fluid_oz_id,
            ],
            [
                "custom_servings_category_id" => $sauces_id,
                "serving_unit_id" => $ml_id,
            ],
        
            [
                "custom_servings_category_id" => $spices_id,
                "serving_unit_id" => $pinch_id,
            ],
            [
                "custom_servings_category_id" => $spices_id,
                "serving_unit_id" => $sprinkle_id,
            ],
            [
                "custom_servings_category_id" => $spices_id,
                "serving_unit_id" => $dash_id,
            ],
            [
                "custom_servings_category_id" => $spices_id,
                "serving_unit_id" => $tbsp_id,
            ],
            [
                "custom_servings_category_id" => $spices_id,
                "serving_unit_id" => $tsp_id,
            ],
            [
                "custom_servings_category_id" => $spices_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $spices_id,
                "serving_unit_id" => $mg_id,
            ],
        
        
            [
                "custom_servings_category_id" => $dried_fruits_id,
                "serving_unit_id" => $pack_id,
            ],
            [
                "custom_servings_category_id" => $dried_fruits_id,
                "serving_unit_id" => $handful_id,
            ],
            [
                "custom_servings_category_id" => $dried_fruits_id,
                "serving_unit_id" => $small_cup_id,
            ],
            [
                "custom_servings_category_id" => $dried_fruits_id,
                "serving_unit_id" => $medium_cup_id,
            ],
            [
                "custom_servings_category_id" => $dried_fruits_id,
                "serving_unit_id" => $large_cup_id,
            ],
            [
                "custom_servings_category_id" => $dried_fruits_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $dried_fruits_id,
                "serving_unit_id" => $mg_id,
            ],

        
            [
                "custom_servings_category_id" => $powders_and_granules_id,
                "serving_unit_id" => $small_cup_id,
            ],
            [
                "custom_servings_category_id" => $powders_and_granules_id,
                "serving_unit_id" => $medium_cup_id,
            ],
            [
                "custom_servings_category_id" => $powders_and_granules_id,
                "serving_unit_id" => $large_cup_id,
            ],
            [
                "custom_servings_category_id" => $powders_and_granules_id,
                "serving_unit_id" => $oz_id,
            ],
            [
                "custom_servings_category_id" => $powders_and_granules_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $powders_and_granules_id,
                "serving_unit_id" => $mg_id,
            ],
            [
                "custom_servings_category_id" => $powders_and_granules_id,
                "serving_unit_id" => $lb_id,
            ],
        
            [
                "custom_servings_category_id" => $ready_to_eat_meal_id,
                "serving_unit_id" => $container_id,
            ],

            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $small_plate_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $medium_plate_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $large_plate_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $saucer_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $lb_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $oz_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $tbsp_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $small_cup_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $medium_cup_id,
            ],
            [
                "custom_servings_category_id" => $homemade_meal_id,
                "serving_unit_id" => $large_cup_id,
            ],

            // eggs
            [
                "custom_servings_category_id" => $eggs_id,
                "serving_unit_id" => $pewee_egg_id,
            ],
            [
                "custom_servings_category_id" => $eggs_id,
                "serving_unit_id" => $extra_small_egg_id,
            ],
            [
                "custom_servings_category_id" => $eggs_id,
                "serving_unit_id" => $small_egg_id,
            ],
            [
                "custom_servings_category_id" => $eggs_id,
                "serving_unit_id" => $medium_egg_id,
            ],
            [
                "custom_servings_category_id" => $eggs_id,
                "serving_unit_id" => $large_egg_id,
            ],
            [
                "custom_servings_category_id" => $eggs_id,
                "serving_unit_id" => $extra_large_egg_id,
            ],
            [
                "custom_servings_category_id" => $eggs_id,
                "serving_unit_id" => $jumbo_egg_id,
            ],
            
        
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $jar_id,
            ],
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $dip_id,
            ],
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $packet_id,
            ],
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $tbsp_id,
            ],
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $tsp_id,
            ],
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $liter_id,
            ],
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $ml_id,
            ],
            [
                "custom_servings_category_id" => $condiments_id,
                "serving_unit_id" => $fluid_oz_id,
            ],
        
            [
                "custom_servings_category_id" => $meat_fish_poultry_id,
                "serving_unit_id" => $pack_id,
            ],
            [
                "custom_servings_category_id" => $meat_fish_poultry_id,
                "serving_unit_id" => $slice_id,
            ],
            [
                "custom_servings_category_id" => $meat_fish_poultry_id,
                "serving_unit_id" => $piece_id,
            ],
            [
                "custom_servings_category_id" => $meat_fish_poultry_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $meat_fish_poultry_id,
                "serving_unit_id" => $lb_id,
            ],
            [
                "custom_servings_category_id" => $meat_fish_poultry_id,
                "serving_unit_id" => $kg_id,
            ],
            [
                "custom_servings_category_id" => $meat_fish_poultry_id,
                "serving_unit_id" => $oz_id,
            ],

        
            [
                "custom_servings_category_id" => $fruits_and_veggies_id,
                "serving_unit_id" => $pack_id,
            ],
            [
                "custom_servings_category_id" => $fruits_and_veggies_id,
                "serving_unit_id" => $gram_id,
            ],
            [
                "custom_servings_category_id" => $fruits_and_veggies_id,
                "serving_unit_id" => $mg_id,
            ],
            [
                "custom_servings_category_id" => $fruits_and_veggies_id,
                "serving_unit_id" => $lb_id,
            ],
            [
                "custom_servings_category_id" => $fruits_and_veggies_id,
                "serving_unit_id" => $kg_id,
            ],
            [
                "custom_servings_category_id" => $fruits_and_veggies_id,
                "serving_unit_id" => $oz_id,
            ],


            [
                "custom_servings_category_id" => $canned_goods_id,
                "serving_unit_id" => $can_id,
            ],
            [
                "custom_servings_category_id" => $canned_goods_id,
                "serving_unit_id" => $lb_id,
            ],
            [
                "custom_servings_category_id" => $canned_goods_id,
                "serving_unit_id" => $kg_id,
            ],
            [
                "custom_servings_category_id" => $canned_goods_id,
                "serving_unit_id" => $oz_id,
            ],
            [
                "custom_servings_category_id" => $canned_goods_id,
                "serving_unit_id" => $gram_id,
            ],
        ];

        foreach ($custom_serving_units as $row) {
            DB::table('custom_servings_category_units')
                ->insert([
                    'custom_servings_category_id' => $row['custom_servings_category_id'],
                    'serving_unit_id' => $row['serving_unit_id'],
                ]);
        }
        
    }
}
