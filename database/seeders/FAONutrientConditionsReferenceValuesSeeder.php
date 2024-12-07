<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAONutrientContentClaimsCondition;
use App\Models\FAONutrientReferenceValue;
use App\Models\FAONutrientConditionsReferenceValue;


class FAONutrientConditionsReferenceValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $protein_conditions = FAONutrientContentClaimsCondition::where('component', 'protein')->get();
        $protein_reference_value = FAONutrientReferenceValue::where('nutrient', 'protein')->first();

        foreach ($protein_conditions as $row) {
            FAONutrientConditionsReferenceValue::create([
                'reference_id' => $protein_reference_value->id,
                'claim_id' => $row->id,
            ]);
        }

        $vitamins_minerals_conditions = FAONutrientContentClaimsCondition::where('component', 'vitamins and minerals')->get();
        $vitamins_minerals_reference_values = FAONutrientReferenceValue::whereNot('nutrient', 'protein')->get();

        foreach ($vitamins_minerals_conditions as $condition_row) {

            foreach ($vitamins_minerals_reference_values as $vitamins_minerals_row) {
                FAONutrientConditionsReferenceValue::create([
                    'reference_id' => $vitamins_minerals_row->id,
                    'claim_id' => $condition_row->id,
                ]);
            }
            
        }

    }
}
