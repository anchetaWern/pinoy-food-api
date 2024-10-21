<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PDRIAverageRequirement;
use App\Models\PDRIEnergyIntake;
use App\Models\PDRIMacronutrientIntake;
use App\Models\PDRIMineralIntake;
use App\Models\PDRIVitaminIntake;

class ConsolidatedRecommendedDailyNutrientIntakeController extends Controller
{
    public function __invoke(Request $request)
    {
        $average_requirements_data = $this->getAverageRequirements($request);
        $macronutrient_data = $this->getMacroData($request);
        $calorie_data = $this->getCalorieData($request);
        $vitamin_data = $this->getVitaminData($request);
        $mineral_data = $this->getMineralData($request);

        $daily_values = [
            ["nutrient" => "calories", "daily_value" => $calorie_data->male_energy_req_in_kcal, "unit" => "kcal"],
            ["nutrient" => "sugar", "daily_value" => 50, "unit" => "g"],
            ["nutrient" => "biotin", "daily_value" => 30, "unit" => "mcg"],
            ["nutrient" => "calcium", "daily_value" => $average_requirements_data->male_calcium, "unit" => "mg"],
            ["nutrient" => "chloride", "daily_value" => $mineral_data->chloride, "unit" => "mg"],
            ["nutrient" => "choline", "daily_value" => 550, "unit" => "mg"],
            ["nutrient" => "cholesterol", "daily_value" => 300, "unit" => "mg"],
            ["nutrient" => "chromium", "daily_value" => 35, "unit" => "mcg"],
            ["nutrient" => "copper", "daily_value" => 0.9, "unit" => "mg"],
            ["nutrient" => "dietary fiber", "daily_value" => $macronutrient_data->fiber_from_in_grams, "unit" => "g"],
            ["nutrient" => "fluoride", "daily_value" => $mineral_data->male_fluoride, "unit" => "mg"],
            ["nutrient" => "total fat", "daily_value" => 42.16, "unit" => "g"],
            ["nutrient" => "vitamin b9", "daily_value" => $average_requirements_data->male_folate, "unit" => "µgDFE"], // folate
            ["nutrient" => "iodine", "daily_value" => $average_requirements_data->male_iodine, "unit" => "mcg"],
            ["nutrient" => "iron", "daily_value" => $average_requirements_data->male_iron, "unit" => "mg"],
            ["nutrient" => "magnesium", "daily_value" => $mineral_data->male_magnesium, "unit" => "mg"],
            ["nutrient" => "manganese", "daily_value" => 2.3, "unit" => "mg"],
            ["nutrient" => "molybdenum", "daily_value" => 45, "unit" => "mcg"],
            ["nutrient" => "vitamin b3", "daily_value" => $average_requirements_data->male_niacin, "unit" => "mgNE"], // niacin
            ["nutrient" => "vitamin b5", "daily_value" => 5, "unit" => "mg"], // pantothenic acid
            ["nutrient" => "phosphorus", "daily_value" => $average_requirements_data->male_phosphorus, "unit" => "mg"],
            ["nutrient" => "potassium", "daily_value" => $mineral_data->potassium, "unit" => "mg"],
            ["nutrient" => "protein", "daily_value" => $average_requirements_data->male_protein, "unit" => "g"],
            ["nutrient" => "vitamin b2", "daily_value" => $average_requirements_data->male_riboflavin, "unit" => "mg"], // riboflavin
            ["nutrient" => "saturated fat", "daily_value" => 20, "unit" => "g"],
            ["nutrient" => "selenium", "daily_value" => $average_requirements_data->male_selenium, "unit" => "mcg"],
            ["nutrient" => "sodium", "daily_value" => $mineral_data->sodium, "unit" => "mg"],
            ["nutrient" => "vitamin b1", "daily_value" => $average_requirements_data->male_thiamin, "unit" => "mg"], // thiamine
            ["nutrient" => "total carbohydrates", "daily_value" => 347.75, "unit" => "g"],
            ["nutrient" => "vitamin a", "daily_value" => $average_requirements_data->male_vitamin_a, "unit" => "µgRE"], // microgram retinol equivalent
            ["nutrient" => "vitamin b6", "daily_value" => $average_requirements_data->male_pyridoxine, "unit" => "mg"], // pyridoxine
            ["nutrient" => "vitamin b12", "daily_value" => $average_requirements_data->male_cobalamin, "unit" => "µg"], // cobalamin
            ["nutrient" => "vitamin c", "daily_value" => $average_requirements_data->male_vitamin_c, "unit" => "mg"],
            ["nutrient" => "vitamin d", "daily_value" => $vitamin_data->male_vitamin_a, "unit" => "µg"], // microgram
            ["nutrient" => "vitamin e", "daily_value" => $vitamin_data->male_vitamin_e, "unit" => "mg α-TE"],
            ["nutrient" => "vitamin k", "daily_value" => $vitamin_data->male_vitamin_k, "unit" => "µg"], // microgram
            ["nutrient" => "zinc", "daily_value" => $average_requirements_data->male_zinc, "unit" => "mg"]
        ];
        
        return $daily_values;
    }


    private function getAverageRequirements($request)
    {
        $query = PDRIAverageRequirement::query();
        $gender = $request->has('gender') ? $request->gender : null;
         
        $age = $request->age;
        $age_type = $request->has('age_type') ? $request->age_type : 'year';

        $res = $query
            ->where('age_type', $age_type)
            ->where('age_from', '<=', $age)
            ->where(function ($query) use ($age) {
                $query->where('age_to', '>=', $age)
                    ->orWhereNull('age_to');
            });

        if ($gender) {
            $res = $res->select(array_merge(
                PDRIAverageRequirement::UNGENDERED_FIELDS,
                $gender === 'male' ? PDRIAverageRequirement::MALE_FIELDS : PDRIAverageRequirement::FEMALE_FIELDS
            ));
        }
        
        return $res->first();
    }


    private function getMacroData($request)
    {
        $age = $request->age;
        $gender = $request->gender;
        $age_type = $request->has('age_type') ? $request->age_type : 'year';

        $query = PDRIMacronutrientIntake::query();
        
        $res = $query
            ->where('age_type', $age_type)
            ->where('age_from', '<=', $age)
            ->where(function ($query) use ($age) {
                $query->where('age_to', '>=', $age)
                    ->orWhereNull('age_to');
            });

        if ($gender) {
            $res = $res->select(array_merge(
                PDRIMacroNutrientIntake::UNGENDERED_FIELDS,
                $gender === 'male' ? PDRIMacronutrientIntake::MALE_FIELDS : PDRIMacronutrientIntake::FEMALE_FIELDS
            ));
        }

        return $res->first();
    }


    private function getCalorieData($request)
    {
        $query = PDRIEnergyIntake::query();
        $gender = $request->has('gender') ? $request->gender : null;

        $age = $request->age;
        $age_type = $request->has('age_type') ? $request->age_type : 'year';

        $res = $query
            ->where('age_type', $age_type)
            ->where('age_from', '<=', $age)
            ->where(function ($query) use ($age) {
                $query->where('age_to', '>=', $age)
                    ->orWhereNull('age_to');
            });

        if ($gender) {
            $res = $res->select(array_merge(
                PDRIEnergyIntake::UNGENDERED_FIELDS,
                $gender === 'male' ? PDRIEnergyIntake::MALE_FIELDS : PDRIEnergyIntake::FEMALE_FIELDS
            ));
        }

        return $res->first();  
    }


    private function getVitaminData($request)
    {
        $query = PDRIVitaminIntake::query();

        $gender = $request->has('gender') ? $request->gender : null;
        $age = $request->age;
        $age_type = $request->has('age_type') ? $request->age_type : 'year';

        $res = $query
            ->where('age_type', $age_type)
            ->where('age_from', '<=', $age)
            ->where(function ($query) use ($age) {
                $query->where('age_to', '>=', $age)
                    ->orWhereNull('age_to');
            });

        if ($gender) {
            $res = $res->select(array_merge(
                PDRIVitaminIntake::UNGENDERED_FIELDS,
                $gender === 'male' ? PDRIVitaminIntake::MALE_FIELDS : PDRIVitaminIntake::FEMALE_FIELDS
            ));
        }

        return $res->first();
       
    }


    private function getMineralData($request) 
    {
        $query = PDRIMineralIntake::query();

        $gender = $request->has('gender') ? $request->gender : null;            
        $age = $request->age;

        $age_type = $request->has('age_type') ? $request->age_type : 'year';
        
        $res = $query
            ->where('age_type', $age_type)
            ->where('age_from', '<=', $age)
            ->where(function ($query) use ($age) {
                $query->where('age_to', '>=', $age)
                    ->orWhereNull('age_to');
            });

        if ($gender) {
            $res = $res->select(array_merge(
                PDRIMineralIntake::UNGENDERED_FIELDS,
                $gender === 'male' ? PDRIMineralIntake::MALE_FIELDS : PDRIMineralIntake::FEMALE_FIELDS
            ));
        }

        return $res->first();
    }

}
