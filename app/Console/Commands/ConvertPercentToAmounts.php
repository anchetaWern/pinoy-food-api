<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReniMineralIntake;
use App\Models\ReniVitaminIntake;

use App\Models\PDRIMineralIntake;
use App\Models\PDRIVitaminIntake;

use App\Models\FoodNutrient;
use Str;

class ConvertPercentToAmounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-percent-to-amounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert percentage values to actual nutrient value';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reni_mineral_intake_values = ReniMineralIntake::where('age_from', 19)->select(array_merge(
            ReniMineralIntake::UNGENDERED_FIELDS,
            ReniMineralIntake::MALE_FIELDS
        ))->first();
      
        $reni_vitamin_intake_values = ReniVitaminIntake::where('age_from', 19)->select(array_merge(
            ReniVitaminIntake::UNGENDERED_FIELDS,
            ReniVitaminIntake::MALE_FIELDS
        ))->first();
    
       
        $pdri_mineral_intake_values = PDRIMineralIntake::where('age_from', 19)->select(array_merge(
            PDRIMineralIntake::UNGENDERED_FIELDS,
            PDRIMineralIntake::MALE_FIELDS
        ))->first(); // sodium, potassium, chloride dont have male_ prefix
    
       
        $pdri_vitamin_intake_values = PDRIVitaminIntake::where('age_from', 19)->select(array_merge(
            PDRIVitaminIntake::UNGENDERED_FIELDS,
            PDRIVitaminIntake::MALE_FIELDS
        ))->first(); 
    
        $common_nutrient_units = [
            "dietary fiber" => "g",
            "protein" => "g",
            "total fat" => "g",
            "cholesterol" => "mg",
            "total carbohydrates" => "g",
            "sugar" => "g",
            "sodium" => "mg",
            "potassium" => "mg",
            "calcium" => "mg",
            "fluoride" => "mg",
            "iron" => "mg",
            "magnesium" => "mg",
            "zinc" => "mg",
            "selenium" => "mcg",
            "vitamin a" => "mcg RAE",
            "vitamin c" => "mg",
            "vitamin d" => "mcg",
            "vitamin e" => "mg α-tocopherol",
            "vitamin k" => "mcg",
            "vitamin b1" => "mg",
            "vitamin b2" => "mg",
            "vitamin b3" => "mg NE",
            "vitamin b6" => "mg",
            "vitamin b9" => "mcg DFE",
            "vitamin b12" => "mcg",
            "biotin" => "mcg",
            "chloride" => "mg",
            "choline" => "mg",
            "chromium" => "mcg",
            "copper" => "mg",
            "total fiber" => "g",
            "iodine" => "mcg",
            "manganese" => "mg",
            "molybdenum" => "mcg",
            "vitamin b5" => "mg",
            "phosphorus" => "mg",
            "saturated fat" => "g"
        ];
        
    
        function getNutrientValue($nutrient_name, $nutrients, $prefix) {
            // pdri vitamins
            $pdri_vitamin_a = 'male_vitamin_a';
            $pdri_vitamin_d = 'male_vitamin_d';
            $pdri_vitamin_e = 'male_vitamin_e';
            $pdri_vitamin_k = 'male_vitamin_k';
            
            $pdri_vitamin_b1 = 'male_thiamin';
            $pdri_vitamin_b2 = 'male_riboflavin';
            $pdri_vitamin_b3 = 'male_niacin';
            $pdri_vitamin_b6 = 'male_pyridoxine';
            $pdri_vitamin_b12 = 'male_cobalamin';
            $pdri_vitamin_b9 = 'male_folate';
            $pdri_vitamin_c = 'male_vitamin_c';
    
            // pdri minerals
            $pdri_sodium = 'sodium';
            $pdri_chloride = 'chloride';
            $pdri_potassium = 'potassium';
            $pdri_iron = 'male_iron';
            $pdri_zinc = 'male_zinc';
            $pdri_selenium = 'male_selenium';
            $pdri_iodine = 'male_iodine';
            $pdri_calcium = 'male_calcium';
            $pdri_magnesium = 'male_magnesium';
            $pdri_phosphorus = 'male_phosphorus';
            $pdri_fluoride = 'male_fluoride';
    
            // reni vitamins
            $reni_vitamin_a = 'male_vitamin_a';
            $reni_vitamin_c = 'male_vitamin_c';
            $reni_vitamin_b1 = 'male_vitamin_b1';
            $reni_vitamin_b2 = 'male_vitamin_b2';
            $reni_vitamin_b3 = 'male_vitamin_b3';
            $reni_vitamin_b9 = 'male_vitamin_b9';
            $reni_vitamin_d = 'male_vitamin_d';
            $reni_vitamin_e = 'male_vitamin_e';
            $reni_vitamin_k = 'male_vitamin_k';
            $reni_vitamin_b6 = 'male_vitamin_b6';
            $reni_vitamin_b12 = 'male_vitamin_b12';
    
            // reni minerals
            $reni_calcium = 'male_calcium';
            $reni_iron = 'male_iron';
            $reni_iodine = 'male_iodine';
            $reni_magnesium = 'male_magnesium';
            $reni_phosphorus = 'male_phosphorus';
            $reni_zinc = 'male_zinc';
            $reni_selenium = 'male_selenium';
            $reni_fluoride = 'male_fluoride';
            $reni_manganese = 'male_manganese';
        
            $real_name = $prefix . Str::snake($nutrient_name);
            
            return isset($$real_name) ? $nutrients->{$$real_name} : null;
        }
    
        function isMineral($nutrient_name) {
            $minerals = [
                'calcium', 'iron', 'iodine', 'phosphorus', 'manganese', 'fluoride',
                'selenium', 'sodium', 'potassium', 'magnesium', 'zinc', 'chloride'
            ];
    
            return in_array($nutrient_name, $minerals);
        }
    
        function getNutrientContent($daily_req, $percent_fulfilled)
        {
            return $daily_req * $percent_fulfilled / 100;
        }
        
        $nutrients = FoodNutrient::where('unit', '%')
            ->join('foods', 'food_nutrients.food_id', '=', 'foods.id')
            ->select('food_nutrients.id', 'foods.id AS food_id', 'name', 'amount')
            ->get();
    
        foreach ($nutrients as $row) {
           
            $prefix = $row->food->daily_values_reference === 'reni_2002' ? 'reni_' : 'pdri_';
            $minerals_to_use = $prefix === 'reni_' ? $reni_mineral_intake_values : $pdri_mineral_intake_values;
            $vitamins_to_use = $prefix === 'pdri_' ? $reni_vitamin_intake_values : $pdri_vitamin_intake_values;
    
            $values_to_use = isMineral($row->name) ? $minerals_to_use : $vitamins_to_use;
            $daily_req = getNutrientValue($row->name, $values_to_use, $prefix);

            $this->info($row->food->description_slug . ": " . $row->amount . $row->unit . " of DV");
            $this->info($row->name . " -> " . $daily_req);
    
            // nutrient daily requirement * percentage fulfilled in food label / 100
            $nutrient_content = getNutrientContent($daily_req, $row->amount);

            if ($nutrient_content) {
                $nutrient_unit = $common_nutrient_units[$row->name];
                $this->info("updated: " . $row->id . " -> " . $nutrient_content . $nutrient_unit);
                
                FoodNutrient::where('id', $row->id)
                    ->update([
                        'amount' => $nutrient_content,
                        'unit' => $nutrient_unit,
                    ]);
                
            }
            $this->info('==================');
        }
    }
}
