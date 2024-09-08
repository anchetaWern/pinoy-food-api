<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdditiveFunctionName;
use App\Models\Additive;
use App\Models\AdditiveFunction;
use avadim\FastExcelReader\Excel;

class AdditivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $functions = [
            "Acidity Regulator",
            "Preservative",
            "Emulsifier",
            "Stabilizer",
            "Sequestrant",
            "Bulking Agent",
            "Thickener",
            "Firming Agent",
            "Raising Agent",
            "Sweetener",
            "Colour",
            "Adjuvant",
            "Enzyme",
            "Flour Treatment Agent",
            "Flavor Enhancer",
            "Leavening Agent",
            "Buffering Agent",
            "Antioxidant",
            "Colour Retention Agent",
            "Bleaching Agent (Not for Flour)",
            "Antifoaming Agent",
            "Filler",
            "Glazing Agent",
            "Release Agent",
            "Propellant",
            "Humectant",
            "Crystallization Inhibitor",
            "Foaming Agent",
            "Packing Gas",
            "Carrier Solvent",
            "Chelator",
            "Acidulant",
            "Plasticizer",
            "Binder", 
            "Nutrient", 
            "Anticaking Agent",
        ];

       
        foreach ($functions as $function_name) {
            AdditiveFunctionName::create([
                'name' => $function_name
            ]);
        }
        
        
       
        $file = storage_path('app/data/food-additives/additives.xlsx');

        $excel = Excel::open($file);

        $result =  $excel->selectSheet('Additives')->readRows(true);
        $processed_result = collect($result)->values()->toArray();

        foreach ($processed_result as $row) {
            Additive::create([
                'name' => $row['Additive'],
                'INS' => $row['INS No'],
                'purpose' => $row['Function'],
                'info' => $row['Info'],
                'health_risks' => $row['Health risks'],
            ]);
        }
       
      
        $abbreviations = [
            "Acidity Reg." => "Acidity Regulator",
            "Adj." => "Adjuvant",
            "Agt" => "Agent",
            "Anticaking Agt" => "Anticaking Agent",
         
            "Bleaching Agt (Not for Flour)" => "Bleaching Agent (Not for Flour)",
            "Thk" => "Thickener",
            "Seq." => "Sequestrant",
            "Flavour Enh" => "Flavor Enhancer",
            "Flavour Enhancer" => "Flavor Enhancer",
            "Flour Trt Agt" => "Flour Treatment Agent",
            "Firming Agt" => "Firming Agent",
            "Pres." => "Preservative",
            "Emulsifiers" => "Emulsifier",

            "Buffering Agt" => "Buffering Agent",
            "Leavening Agt" => "Leavening Agent",

            "Colour" => "Color",
            "Colour Retention Agent" => "Color Retention Agent", 
        ];

       
        $additives = Additive::get();
        foreach ($additives as $row) {

            $functions = explode(',', $row->purpose);
            foreach ($functions as $func_name) {
                $funk = isset($abbreviations[$func_name]) ? trim($abbreviations[$func_name]) : null;

                $additive_function = AdditiveFunctionName::where('name', '=', trim($func_name))
                    ->when($funk !== null, function($query) use ($funk) {
                        $query->orWhere('name', '=', $funk);
                    })
                    ->first();
                if ($additive_function) {
                    AdditiveFunction::create([
                        'additive_id' => $row->id,
                        'function_id' => $additive_function->id,
                    ]);
                } 
            }

        }
    }
}
