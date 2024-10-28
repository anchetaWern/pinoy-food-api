<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PDRIAverageRequirement;
use App\Models\PDRIEnergyIntake;
use App\Models\PDRIMacronutrientIntake;
use App\Models\PDRIMineralIntake;
use App\Models\PDRIVitaminIntake;
use App\Models\FdaDailyValuesForNutrient;

use App\Models\ReniMineralIntake;
use App\Models\ReniVitaminIntake;

class ConsolidatedRecommendedDailyNutrientIntakeController extends Controller
{

    private function getReniMineralsData($request)
    {
        $query = ReniMineralIntake::query();
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
                ReniMineralIntake::UNGENDERED_FIELDS,
                $gender === 'male' ? ReniMineralIntake::MALE_FIELDS : ReniMineralIntake::FEMALE_FIELDS
            ));
        }

        return $res->first();  
    }   


    private function getReniVitaminsAndCaloriesData($request)
    {
        $query = ReniVitaminIntake::query();
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
                ReniVitaminIntake::UNGENDERED_FIELDS,
                $gender === 'male' ? ReniVitaminIntake::MALE_FIELDS : ReniVitaminIntake::FEMALE_FIELDS
            ));
        }

        return $res->first();  
    }


    public function __invoke(Request $request)
    {
        $pdri_average_requirements_data = $this->getPdriAvgRequirementsData($request);
        $pdri_macronutrient_data = $this->getPdriMacrosData($request);
        $pdri_calories_data = $this->getPdriCaloriesData($request);
       
        $pdri_vitamins_data = $this->getPdriVitaminsData($request);
        $pdri_minerals_data = $this->getPdriMineralsData($request);

        $reni_minerals_data = $this->getReniMineralsData($request);
        $reni_calories_and_vitamins_data = $this->getReniVitaminsAndCaloriesData($request);

        $fda_daily_values = $this->getFdaDailyValues();

        $sugar = $this->findFdaDailyValue($fda_daily_values, 'sugar');
        $biotin = $this->findFdaDailyValue($fda_daily_values, 'biotin');
        $choline = $this->findFdaDailyValue($fda_daily_values, 'choline');
        $cholesterol = $this->findFdaDailyValue($fda_daily_values, 'cholesterol');
        $chromium = $this->findFdaDailyValue($fda_daily_values, 'chromium');
        $copper = $this->findFdaDailyValue($fda_daily_values, 'copper');
        $total_fat = $this->findFdaDailyValue($fda_daily_values, 'total fat');
        $manganese = $this->findFdaDailyValue($fda_daily_values, 'manganese');
        $molybdenum = $this->findFdaDailyValue($fda_daily_values, 'molybdenum');
        $vitamin_b5 = $this->findFdaDailyValue($fda_daily_values, 'vitamin b5');
        $saturated_fat = $this->findFdaDailyValue($fda_daily_values, 'saturated fat');

        $is_pdri_2015 = true;
        if ($request->has('daily_values_reference')) {
            $is_pdri_2015 = $request->daily_values_reference === 'pdri_2015';
        }

        $calories_value = $is_pdri_2015 ? $pdri_calories_data->male_energy_req_in_kcal : $reni_calories_and_vitamins_data->male_energy_req_in_kcal;
        $calcium_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_calcium : $reni_minerals_data->male_calcium;
        $vitamin_b9_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_folate : $reni_calories_and_vitamins_data->male_vitamin_b9;
        $iodine_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_iodine : $reni_minerals_data->male_iodine;
        $iron_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_iron : $reni_minerals_data->male_iron;
        $magnesium_value = $is_pdri_2015 ? $pdri_minerals_data->male_magnesium : $reni_minerals_data->male_magnesium;
        $manganese_value = $is_pdri_2015 ? $manganese->daily_value : $reni_minerals_data->male_manganese;
        $vitamin_b3_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_niacin : $reni_calories_and_vitamins_data->male_vitamin_b3;
        $phosphorus_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_phosphorus : $reni_minerals_data->male_phosphorus;
        $protein_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_protein : $reni_calories_and_vitamins_data->male_protein_in_g;

        $vitamin_b2_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_riboflavin : $reni_calories_and_vitamins_data->male_vitamin_b2;
        $selenium_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_selenium : $reni_minerals_data->male_selenium;

        $vitamin_b1_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_thiamin : $reni_calories_and_vitamins_data->male_vitamin_b1;

        $vitamin_a_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_vitamin_a : $reni_calories_and_vitamins_data->male_vitamin_a;

        $vitamin_b6_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_pyridoxine : $reni_calories_and_vitamins_data->male_vitamin_b6;
        $vitamin_b12_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_cobalamin : $reni_calories_and_vitamins_data->male_vitamin_b12;

        $vitamin_c_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_vitamin_c : $reni_calories_and_vitamins_data->male_vitamin_c;

        $vitamin_d_value = $is_pdri_2015 ? $pdri_vitamins_data->male_vitamin_d : $reni_calories_and_vitamins_data->male_vitamin_d;

        $vitamin_e_value = $is_pdri_2015 ? $pdri_vitamins_data->male_vitamin_e : $reni_calories_and_vitamins_data->male_vitamin_e;

        $vitamin_k_value = $is_pdri_2015 ? $pdri_vitamins_data->male_vitamin_k : $reni_calories_and_vitamins_data->male_vitamin_k;

        $zinc_value = $is_pdri_2015 ? $pdri_average_requirements_data->male_zinc : $reni_minerals_data->male_zinc;

        $daily_values = [
            ["nutrient" => "calories", "daily_value" => $calories_value, "unit" => "kcal"],
            ["nutrient" => "sugar", "daily_value" => $sugar->daily_value, "unit" => $sugar->unit],
            ["nutrient" => "biotin", "daily_value" => $biotin->daily_value, "unit" => $biotin->unit],
            ["nutrient" => "calcium", "daily_value" => $calcium_value, "unit" => "mg"],
            ["nutrient" => "chloride", "daily_value" => $pdri_minerals_data->chloride, "unit" => "mg"],
            ["nutrient" => "choline", "daily_value" => $choline->daily_value, "unit" => $choline->unit],
            ["nutrient" => "cholesterol", "daily_value" => $cholesterol->daily_value, "unit" => $cholesterol->unit],
            ["nutrient" => "chromium", "daily_value" => $chromium->daily_value, "unit" => $chromium->unit],
            ["nutrient" => "copper", "daily_value" => $copper->daily_value, "unit" => $copper->unit],
            ["nutrient" => "dietary fiber", "daily_value" => $pdri_macronutrient_data->fiber_from_in_grams, "unit" => "g"],
            ["nutrient" => "fluoride", "daily_value" => $pdri_minerals_data->male_fluoride, "unit" => "mg"],
            ["nutrient" => "total fat", "daily_value" => 42.16, "unit" => "g"],
            ["nutrient" => "vitamin b9", "daily_value" => $vitamin_b9_value, "unit" => "µgDFE"], // folate
            ["nutrient" => "iodine", "daily_value" => $iodine_value, "unit" => "mcg"],
            ["nutrient" => "iron", "daily_value" => $iron_value, "unit" => "mg"],
            ["nutrient" => "magnesium", "daily_value" => $magnesium_value, "unit" => "mg"],
            ["nutrient" => "manganese", "daily_value" => $manganese_value, "unit" => $manganese->unit],
            ["nutrient" => "molybdenum", "daily_value" => $molybdenum->daily_value, "unit" => $molybdenum->unit],
            ["nutrient" => "vitamin b3", "daily_value" => $vitamin_b3_value, "unit" => "mgNE"], // niacin
            ["nutrient" => "vitamin b5", "daily_value" => $vitamin_b5->daily_value, "unit" => $vitamin_b5->unit], // pantothenic acid
            ["nutrient" => "phosphorus", "daily_value" => $phosphorus_value, "unit" => "mg"],
            ["nutrient" => "potassium", "daily_value" => $pdri_minerals_data->potassium, "unit" => "mg"],
            ["nutrient" => "protein", "daily_value" => $protein_value, "unit" => "g"],
            ["nutrient" => "vitamin b2", "daily_value" => $vitamin_b2_value, "unit" => "mg"], // riboflavin
            ["nutrient" => "saturated fat", "daily_value" => $saturated_fat->daily_value, "unit" => $saturated_fat->unit],
            ["nutrient" => "selenium", "daily_value" => $selenium_value, "unit" => "mcg"],
            ["nutrient" => "sodium", "daily_value" => $pdri_minerals_data->sodium, "unit" => "mg"],
            ["nutrient" => "vitamin b1", "daily_value" => $vitamin_b1_value, "unit" => "mg"], // thiamine
            ["nutrient" => "total carbohydrates", "daily_value" => 347.75, "unit" => "g"],
            ["nutrient" => "vitamin a", "daily_value" => $vitamin_a_value, "unit" => "µgRE"], // microgram retinol equivalent
            ["nutrient" => "vitamin b6", "daily_value" => $vitamin_b6_value, "unit" => "mg"], // pyridoxine
            ["nutrient" => "vitamin b12", "daily_value" => $vitamin_b12_value, "unit" => "µg"], // cobalamin
            ["nutrient" => "vitamin c", "daily_value" => $vitamin_c_value, "unit" => "mg"],
            ["nutrient" => "vitamin d", "daily_value" => $vitamin_d_value, "unit" => "µg"], // microgram
            ["nutrient" => "vitamin e", "daily_value" => $vitamin_e_value, "unit" => "mg α-TE"],
            ["nutrient" => "vitamin k", "daily_value" => $vitamin_k_value, "unit" => "µg"], // microgram
            ["nutrient" => "zinc", "daily_value" => $zinc_value, "unit" => "mg"]
        ];
        
        return $daily_values;
    }


    private function getFdaDailyValues()
    {
        $fda_daily_values = FdaDailyValuesForNutrient::get();
        return $fda_daily_values;
    }

    private function findFdaDailyValue($values, $name)
    {
        return $values->first(function($item) use ($name) {
            return $item->nutrient === $name;
        });
    }


    private function getPdriAvgRequirementsData($request)
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


    private function getPdriMacrosData($request)
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


    private function getPdriCaloriesData($request)
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


    private function getPdriVitaminsData($request)
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


    private function getPdriMineralsData($request) 
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
