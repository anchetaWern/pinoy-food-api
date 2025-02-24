<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Food;
use App\Models\FoodNutrient;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use JsonMachine\JsonDecoder\ExtJsonDecoder;
use JsonMachine\Items;
use DB;

class ImportFoodDataCentralFoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:fdc {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports food data from food data central';

    private $nutrient_names_mapping = [
        // elements
        'Water' => 'water',
        'Ash' => 'ash',

        // bioactive compounds
        'Choline, total' => 'choline',
        'Lutein + zeaxanthin' => 'lutein + zeaxanthin',
        'Theobromine' => 'theobromine',
        'Caffeine' => 'caffeine',
        'Retinol' => 'retinol',
        'Carotene, beta' => 'beta-carotene',
        'Carotene, alpha' => 'alpha-carotene',
        'Cryptoxanthin, beta' => 'beta-cryptoxanthin',
        'Lycopene' => 'lycopene',

        // macros
        'Energy' => 'calories',
        'Energy (Atwater Specific Factors)' => 'calories',
        'Protein' => 'protein',
        'Total lipid (fat)' => 'total fat',
        'Total Fat (NLEA)' => 'total fat',
        'Carbohydrate, by difference' => 'total carbohydrates',
        'Fiber, total dietary' => 'dietary fiber',
        'Total Sugars' => 'sugar',
        'Fatty acids, total trans' => 'trans fat',
        'Fatty acids, total saturated' => 'saturated fat',
        'Cholesterol' => 'cholesterol',
        
        // fats
        'SFA 2:0' => 'acetic acid',
        'SFA 3:0' => 'propionic acid',
        'SFA 4:0' => 'butyric acid',
        'SFA 5:0' => 'valeric acid',
        'SFA 6:0' => 'caproic acid',
        'SFA 7:0' => 'enanthic acid',
        'SFA 8:0' => 'caprylic acid',
        'SFA 9:0' => 'pelargonic acid',
        'SFA 10:0' => 'capric acid',
        'SFA 11:0' => 'undecanoic acid',
        'SFA 12:0' => 'lauric acid',
        'SFA 13:0' => 'tridecylic acid',
        'SFA 14:0' => 'myristic acid',
        'SFA 15:0' => 'pentadecylic acid',
        'SFA 16:0' => 'palmitic acid',
        'SFA 17:0' => 'margaric acid',
        'SFA 18:0' => 'stearic acid',
        'SFA 19:0' => 'nonadecylic acid',
        'SFA 20:0' => 'arachidic acid',
        'SFA 21:0' => 'heneicosylic acid',
        'SFA 22:0' => 'behenic acid',
        'SFA 23:0' => 'tricosylic acid',
        'SFA 24:0' => 'lignoceric acid',
        
        // mono-unsaturated fat
        'Fatty acids, total monounsaturated' => 'monounsaturated fat',
        'MUFA 14:1' => 'myristoleic acid',
        'MUFA 15:1' => 'pentadecenoic acid',
        'MUFA 16:1' => 'palmitoleic acid',
        'MUFA 17:1' => 'heptadecenoic acid',
        'MUFA 18:1' => 'oleic acid',
        'MUFA 20:1' => 'gondoic acid',
        'MUFA 22:1' => 'erucic acid',
        'MUFA 24:1' => 'nervonic acid',
        
        // poly-unsaturated fats
        'Fatty acids, total polyunsaturated' => 'polyunsaturated fat',
        'PUFA 18:2' => 'linoleic acid',
        'PUFA 18:3' => 'alpha-linolenic acid',
        'PUFA 18:4' => 'stearidonic acid',
        'PUFA 20:2' => 'eicosadienoic acid',
        'PUFA 20:3' => 'dihomo-gamma-linolenic acid',
        'PUFA 20:4' => 'arachidonic acid',
        'PUFA 20:5' => 'eicosapentaenoic acid (EPA)',
        'PUFA 22:4' => 'adrenic acid',
        'PUFA 22:5' => 'docosapentaenoic acid (DPA)',
        'PUFA 22:6' => 'docosahexaenoic acid (DHA)',

        // sugars
        'Fructose' => 'fructose',
        'Glucose' => 'glucose',
        'Lactose' => 'lactose', 
        'Maltose' => 'maltose', 
        'Sucrose' => 'sucrose', 
        'Galactose' => 'galactose',

        // vitamins
        'Vitamin A, RAE' => 'vitamin a',
        'Thiamin' => 'thiamin',
        'Riboflavin' => 'riboflavin',
        'Niacin' => 'niacin',
        'Pantothenic acid' => 'vitamin b5',
        'Vitamin B-6' => 'vitamin b6',
        'Folate, DFE' => 'vitamin b9',
        'Vitamin B-12' => 'vitamin b12',
        'Vitamin C, total ascorbic acid' => 'vitamin c', 
        'Vitamin E (alpha-tocopherol)' => 'vitamin e', // has types
        'Vitamin D (D2 + D3)' => 'vitamin d', // has types
        // 'Vitamin K' => 'vitamin k', // has types that needs to get the total of

        'Vitamin K (phylloquinone)' => 'phylloquinone', // 'vitamin k: phylloquinone',
        'Vitamin K (Dihydrophylloquinone)' => 'dihydrophylloquinone', // 'vitamin k: dihydrophylloquinone',
        'Vitamin K (Menaquinone-4)' => 'menaquinone-4', // 'vitamin k: menaquinone-4',

        // minerals
        'Calcium, Ca' => 'calcium',
        'Copper, Cu' => 'copper',
        'Fluoride, F' => 'fluoride',
        'Iron, Fe' => 'iron',
        'Magnesium, Mg' => 'magnesium',
        'Manganese, Mn' => 'manganese',
        'Molybdenum, Mo' => 'molybdenum',
        'Nickel, Ni' => 'nickel',
        'Phosphorus, P' => 'phosphorus',
        'Potassium, K' => 'potassium',
        'Selenium, Se' => 'selenium',
        'Sodium, Na' => 'sodium',
        'Sulfur, S' => 'sulfur',
        'Zinc, Zn' => 'zinc',

        // amino-acids
        'Isoleucine' => 'isoleucine',
        'Leucine' => 'leucine',
        'Lysine' => 'lysine',
        'Cysteine' => 'cysteine',
        'Valine' => 'valine',
        
        'Arginine' => 'arginine',
        'Histidine' => 'histidine',
        'Aspartic acid' => 'aspartic acid',
        'Asparagine' => 'aspargine',
        'Tryptophan' => 'tryptophan',
        'Threonine' => 'threonine',
        'Methionine' => 'methionine',
        'Phenylalanine' => 'phenylalanine',
        
        'Tyrosine' => 'tyrosine',
        'Alanine' => 'alanine',
        'Glutamic acid' => 'glutamic acid',
        'Glutamine' => 'glutamine',
        'Glycine' => 'glycine',
        'Betaine' => 'betaine',
        'Serine' => 'serine',
         
    ];

    private $nutrient_categories = [
        'elements' => ['Water', 'Ash'],
        'bioactive-compounds' => ['Choline, total', 'Lutein + zeaxanthin', 'Theobromine', 'Caffeine', 'Carotene, beta', 'Carotene, alpha', 'Cryptoxanthin, beta', 'Lycopene'],
        'macronutrients' => ['Energy', 'Energy (Atwater Specific Factors)', 'Protein', 'Total lipid (fat)', 'Carbohydrate, by difference'],
        'carbohydrates' => [
            'total' => 'Carbohydrate, by difference',
            'dietary fiber' => ['Fiber, total dietary'],
            'sugar' => [
                'Total Sugars',
                'Fructose',
                'Glucose',
                'Lactose', 
                'Maltose', 
                'Sucrose', 
                'Galactose',
            ],
        ],
        'protein' => [
            'Isoleucine', 'Lysine', 'Cysteine', 'Valine', 
            'Arginine', 'Histidine', 'Aspartic acid', 'Asparagine',
            'Tryptophan', 'Threonine', 'Methionine', 'Phenylalanine', 
            'Tyrosine', 'Alanine', 'Glutamic acid', 'Glutamine',
            'Glycine', 'Betaine', 'Serine', 'Leucine',
        ],
        'fat' => [
            'total' => 'Total lipid (fat)',
            'saturated fat' => [
                'Fatty acids, total saturated', 
                'SFA 2:0', 'SFA 3:0', 'SFA 4:0', 'SFA 5:0', 'SFA 6:0', 'SFA 7:0', 'SFA 8:0',
                'SFA 9:0', 'SFA 10:0', 'SFA 11:0', 'SFA 12:0', 'SFA 13:0', 'SFA 14:0',
                'SFA 15:0', 'SFA 16:0', 'SFA 17:0', 'SFA 18:0', 'SFA 19:0', 'SFA 20:0',
                'SFA 21:0', 'SFA 22:0', 'SFA 23:0', 'SFA 24:0'
            ], 
            'monounsaturated fat' => [
                'Fatty acids, total monounsaturated',
                'MUFA 14:1', 'MUFA 15:1', 'MUFA 16:1', 'MUFA 17:1', 'MUFA 18:1', 'MUFA 20:1', 'MUFA 22:1', 'MUFA 24:1',   
            ],
            
            'polyunsaturated fat' => [
                'Fatty acids, total polyunsaturated',
                'PUFA 18:2', 'PUFA 18:3', 'PUFA 18:4', 
                'PUFA 20:2', 'PUFA 20:3', 'PUFA 20:4', 'PUFA 20:5',
                'PUFA 22:4', 'PUFA 22:5', 'PUFA 22:6'
            ],

            'trans fat' => ['Fatty acids, total trans'],
            'cholesterol' => ['Cholesterol'],
        ],
        
        'minerals' => [
            'Calcium, Ca',
            'Copper, Cu',
            'Fluoride, F',
            'Iron, Fe',
            'Magnesium, Mg',
            'Manganese, Mn',
            'Molybdenum, Mo',
            'Nickel, Ni',
            'Phosphorus, P',
            'Potassium, K',
            'Selenium, Se',
            'Sodium, Na',
            'Sulfur, S',
            'Zinc, Zn',
        ],

        'vitamins' => [
            'Vitamin A, RAE',
            'Retinol',

            'Thiamin',
            'Riboflavin',
            'Niacin',
            'Pantothenic acid',
            'Vitamin B-6',
            'Folate, DFE',
            'Vitamin B-12',
            'Vitamin C, total ascorbic acid', 
            'Vitamin E (alpha-tocopherol)', // has types
            'Vitamin D (D2 + D3)', // has types

            // has types that needs to get the total of
           
            'Vitamin K' => 'Vitamin K (phylloquinone)',
                
            'Vitamin K (Dihydrophylloquinone)',
            'Vitamin K (Menaquinone-4)',
            //], 
        ],
    ];
    

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $all_foods = [];

        $foundation_foods = 'foundation-foods-1.json';
        $fndds = 'fndds.json';
        $sr_legacy = 'sr-legacy.json';
        $branded = 'branded.json';

        $foundation_foods_key = '/FoundationFoods';
        $fndds_key = '/SurveyFoods';
        $sr_legacy_key = '/SRLegacyFoods';
        $branded_foods_key = '/BrandedFoods';

    
        $file = $this->option('file');

        $file_mapping = [
            'foundation' => [
                'file' => $foundation_foods,
                'key' => $foundation_foods_key
            ],
            'fndds' => [
                'file' => $fndds,
                'key' => $fndds_key
            ],
            'sr_legacy' => [
                'file' => $sr_legacy,
                'key' => $sr_legacy_key
            ],
            'branded' => [
                'file' => $branded,
                'key' => $branded_foods_key
            ]
        ];


        $filePath = storage_path('app/data/food-data-central/' . $file_mapping[$file]['file']);
        $jsonStream = Items::fromFile($filePath, ['pointer' => $file_mapping[$file]['key'], 'decoder' => new ExtJsonDecoder(true)]);

        foreach ($jsonStream as $food) {
            
            if (!isset($food['foodNutrients']) || empty($food['foodNutrients'])) {
              
                continue;
            }


            $food_data = [
                'custom_id' => isset($food['fdcId']) ? $food['fdcId'] : null,
                'description' => $food['description'],
                'description_slug' => Str::slug($food['description']),

              
                'food_type' => null,
                'food_subtype' => null,

                'food_state' => 1,
                'food_substate' => null,

                'raw_data' => $food,
                
            ];
            
            
            if (isset($food['servingSize'])) {
                
                $food_data['serving_size'] = $food['servingSize'];
                $food_data['serving_size_unit'] = $food['servingSizeUnit'];
            }

            if (isset($food['ingredients'])) {
               
                $food_data['ingredients'] = $food['ingredients'];
            }  
            
            if (isset($food['foodPortions']) && !empty($food['foodPortions']) && count($food['foodPortions']) > 0) {
                
                $default_portion = $food['foodPortions'][0];
                if (!empty($default_portion)) {

                    $food_data['serving_size'] = $default_portion['gramWeight']; 
                    $food_data['serving_size_unit'] = 'g'; 
                    
                    if (isset($default_portion['amount'])) {
                        $food_data['custom_serving_size'] = $default_portion['amount'] . ' ' . $default_portion['measureUnit']['abbreviation'];
                    }
                    
                } else {
                    $food_data['serving_size'] = 100;
                    $food_data['serving_size_unit'] = 'g';
                }
            } else {
                $food_data['serving_size'] = 100;
                $food_data['serving_size_unit'] = 'g';
            } 
           
            

            $food_nutrients = collect($food['foodNutrients']);

            
            $nutrient_data = [];
            foreach (['macronutrients', 'elements', 'bioactive-compounds', 'minerals', 'vitamins'] as $nutrient_group) {
                foreach ($this->nutrient_categories[$nutrient_group] as $nut) {
                    if ($nutrient = $this->getNutrient($food_nutrients, $nut)) {
                        if (isset($nutrient['name'])) {
                          
                            $nutrient_data[] = $nutrient;
                        }
                    }
                }
            }

            // Fetch carb and its composition
            $carbs_composition_data = [];
            foreach (['sugar', 'dietary fiber'] as $carb_type) { // adjust so its able to cater for strings, so for things
                // like fiber where its only one and its not considered as a composition of itself
                $carb_composition = array_filter(array_map(fn($n) => $this->getNutrient($food_nutrients, $n, true), $this->nutrient_categories['carbohydrates'][$carb_type]));
                if (!empty($carb_composition)) {

                    $carb_type_data = array_values($carb_composition);

                    $carb_row_data = [
                        'name' => $carb_type,
                        'amount' => $carb_type_data[0]['amount'] ?? null,
                        'unit' => $carb_type_data[0]['unit'] ?? null,
                    ];
                    
                    $sliced_carb_composition = array_slice($carb_type_data, 1);
                    if (count($sliced_carb_composition) > 0) {
                        $carb_row_data['composition'] = $sliced_carb_composition;
                    }

                    $carbs_composition_data[] = $carb_row_data;
                    
                }
            }

            // vitamin a, d, e, k composition

            // vitamin a
            $vitamin_a_components = ['retinol', 'alpha-carotene', 'beta-carotene', 'beta-cryptoxanthin'];
            $vitamin_a_data = collect($nutrient_data)->filter(function($item) use ($vitamin_a_components) {
                return !empty($item['name']) && isset($item['name']) && in_array($item['name'], $vitamin_a_components);
            })
            ->values()->toArray();

            $vitamin_a_rae = collect($nutrient_data)->firstWhere('name', 'vitamin a');
 
            
            if (!empty($vitamin_a_rae)) {
              
                $vitamin_a_data_row = [
                    'name' => 'vitamin a',
                    'amount' => $vitamin_a_rae['amount'],
                    'unit' => $vitamin_a_rae['unit'],
                ];

                if ($vitamin_a_data) {
                    $vitamin_a_data_row['composition'] = $vitamin_a_data;
                } 

                // find the index of vitamin a
                $vitamin_a_index = collect($nutrient_data)->search(function($item, $key) {
                    return !empty($item) && isset($item['name']) && $item['name'] === 'vitamin a';
                });

                $nutrient_data[$vitamin_a_index] = $vitamin_a_data_row;
                                
            } else {
                
                $no_vitamin_a_data = [
                    'name' => 'vitamin a',
                    'amount' => 0,
                    'unit' => 'µg',
                ];

                if ($vitamin_a_data) {
                    $no_vitamin_a_data['composition'] = $vitamin_a_data;
                }

                $nutrient_data[] = $no_vitamin_a_data;   
            }

            // remove vit a components
            $nutrient_data = collect($nutrient_data)->reject(function($item) use ($vitamin_a_components) {
                return !empty($item) && isset($item['name']) && in_array($item['name'], $vitamin_a_components);
            });
           

            // vitamin e: only alpha-tocopherol is relevant so no need to get the others

            // vitamin d: already includes the total vitamin d via vitamin d: d2 + d3 so no need to get cholecalciferol separately

            // vitamin k
            $vitamin_k_components = ['phylloquinone', 'menaquinone-4', 'dihydrophylloquinone'];
            $vitamin_k_data = collect($nutrient_data)->filter(function($item) use ($vitamin_k_components) {
                return !empty($item) && isset($item['name']) && in_array($item['name'], $vitamin_k_components);
            })
            ->values()
            ->toArray();

          
            if (!empty($vitamin_k_data)) {
                $vitamin_k_total = collect($vitamin_k_data)->sum('amount');

                // add a new item for vitamin k under vitamins, add up the amounts to come up with the total vitamin k
                $nutrient_data[] = [
                    'name' => 'vitamin k',
                    'amount' => $vitamin_k_total,
                    'unit' => $vitamin_k_data[0]['unit'] ?? null,
                    'composition' => $vitamin_k_data,
                ];
                // filter out the existing ones
                $nutrient_data = collect($nutrient_data)->reject(function($item) use ($vitamin_k_components) {
                    return in_array($item['name'], $vitamin_k_components);
                });
            }

            // Fetch protein and its composition
            $protein_composition = array_filter(array_map(fn($n) => $this->getNutrient($food_nutrients, $n, true), $this->nutrient_categories['protein']));
            if (!empty($protein_composition)) {

                $protein = collect($nutrient_data)->firstWhere('name', 'protein');
               
                $protein_index = collect($nutrient_data)->search(function($item, $key) {
                    return !empty($item) && isset($item['name']) && $item['name'] === 'protein';
                });

                if ($protein_index !== false) {
                    $nutrient_data[$protein_index] = [
                        'name' => 'protein',
                        'amount' => $protein['amount'] ?? null, // amount
                        'unit' => $protein['unit'] ?? null,
                        'composition' => array_values($protein_composition)
                    ];
                }
            }


            if (!collect($nutrient_data)->firstWhere('name', 'protein')) {
               
                $nutrient_data[] = [
                    'name' => 'protein',
                    'amount' => 0,
                    'unit' => 'g',
                ];
            }

        
            // Fetch fat categories
            $fat_data = [];
            foreach (['saturated fat', 'monounsaturated fat', 'polyunsaturated fat', 'trans fat', 'cholesterol'] as $fat_type) {
                $fatty_acid_composition = array_filter(array_map(fn($n) => $this->getNutrient($food_nutrients, $n, true), $this->nutrient_categories['fat'][$fat_type]));
                if (!empty($fatty_acid_composition)) {

                    $fat_type_data = collect($nutrient_data)->firstWhere('name', $fat_type);

                    $fatty_acid_composition_data = array_values($fatty_acid_composition);
                    
                    $fat_row_data = [
                        'name' => $fat_type,
                        'amount' => $fatty_acid_composition_data[0]['amount'] ?? null,
                        'unit' => $fatty_acid_composition_data[0]['unit'] ?? null,
                    ];

                    $sliced_fatty_acid_composition_data = array_slice($fatty_acid_composition_data, 1);
                    if (count($sliced_fatty_acid_composition_data) > 0) {
                        $fat_row_data['composition'] = $sliced_fatty_acid_composition_data;
                    }

                    $fat_data[] = $fat_row_data;
                }
            }


            // Add total fat if present
            $total_fat = $this->getNutrient($food_nutrients, $this->nutrient_categories['fat']['total']);

            if (is_null($total_fat)) {
                $total_fat = $this->getNutrient($food_nutrients, 'Total Fat (NLEA)');
            }

            if ($total_fat) {
                $fat_index = collect($nutrient_data)->search(function($item, $index) {
                    return !empty($item) && isset($item['name']) && $item['name'] === 'total fat';
                });

                if ($fat_index !== false) {

                    // group unsaturated fats (PUFAs and MUFAs)
                    $mufas = collect($fat_data)->firstWhere('name', 'monounsaturated fat');
                    $pufas = collect($fat_data)->firstWhere('name', 'polyunsaturated fat');

                 
                    $total_unsaturated_fat = 0;
                    if (isset($mufas['amount'])) {
                        $total_unsaturated_fat += $mufas['amount'];
                    }

                    if (isset($pufas['amount'])) {
                        $total_unsaturated_fat += $pufas['amount'];
                    }

                    $unsaturated_fat_composition = [];

                    if ($mufas) {
                        $unsaturated_fat_composition[] = $mufas;
                    }

                    if ($pufas) {
                        $unsaturated_fat_composition[] = $pufas;
                    }

                    $unsaturated_fat_data = [
                        'name' => 'unsaturated fat',
                        'amount' => $total_unsaturated_fat, 
                        'unit' => $mufas['unit'] ?? 'g',
                    ];

                    if (count($unsaturated_fat_composition) > 0) {
                        $unsaturated_fat_data['composition'] = $unsaturated_fat_composition;
                    }

                    $saturated_fat_data = collect($fat_data)->firstWhere('name', 'saturated fat');

                    $trans_fat_data = collect($fat_data)->firstWhere('name', 'trans fat');
                    $cholesterol_data = collect($fat_data)->firstWhere('name', 'cholesterol');

                    $fat_composition = [];

                    // check if total fat, saturated fat, trans fat and cholesterol is present. if not then add them with 0 value

                    if ($saturated_fat_data) {
                        $fat_composition[] = $saturated_fat_data;
                    } else {
                        $fat_composition[] = [
                            'name' => 'saturated fat',
                            'amount' => 0,
                            'unit' => 'g',
                        ];
                    }

                    if ($unsaturated_fat_data) {
                        $fat_composition[] = $unsaturated_fat_data;
                    } 

                    if ($trans_fat_data) {
                        $fat_composition[] = $trans_fat_data;
                    } else {
                        $fat_composition[] = [
                            'name' => 'trans fat',
                            'amount' => 0,
                            'unit' => 'g',
                        ];
                    }

                    if ($cholesterol_data) {
                        $fat_composition[] = $cholesterol_data;
                    } else {
                        $fat_composition[] = [
                            'name' => 'cholesterol',
                            'amount' => 0,
                            'unit' => 'mg',
                        ];
                    }

                    $nutrient_data[$fat_index] = [
                        'name' => 'total fat',
                        'amount' => $total_fat['amount'],
                        'unit' => $total_fat['unit'],
                        'composition' => $fat_composition
                    ];
                }
            }


         
            if ($total_carbs = $this->getNutrient($food_nutrients, $this->nutrient_categories['carbohydrates']['total'])) {

                $carbs = collect($nutrient_data)->firstWhere('name', 'total carbohydrates');
                $carbs_index = collect($nutrient_data)->search(function($item, $index) {
                    return !empty($item) && isset($item['name']) && $item['name'] === 'total carbohydrates';
                });

                if ($carbs_index !== false) {
                    $carbs_data = [
                        'name' => 'total carbohydrates',
                        'amount' => $carbs['amount'] ?? null, // amount
                        'unit' => $carbs['unit'] ?? null,
                    ];

                    if (!collect($carbs_composition_data)->firstWhere('name', 'sugar')) {
                        $carbs_composition_data[] = [
                            'name' => 'sugar',
                            'amount' => 0,
                            'unit' => 'g',
                        ];
                    }

                    if (!collect($carbs_composition_data)->firstWhere('name', 'dietary fiber')) {
                        $carbs_composition_data[] = [
                            'name' => 'dietary fiber',
                            'amount' => 0,
                            'unit' => 'g',
                        ];
                    }

                    if (!empty($carbs_composition_data)) {
                        $carbs_data['composition'] = $carbs_composition_data;
                    }

                    $nutrient_data[$carbs_index] = $carbs_data;

                }
            } 

            


            // check if vit a, vit c, calcium and iron are present. if not then add them with 0 value
            $required_vitamins_and_minerals = collect($nutrient_data)->whereIn('name', ['vitamin a', 'vitamin c', 'calcium', 'iron'])
                ->pluck('name')
                ->all();
                
            if (!in_array('vitamin a', $required_vitamins_and_minerals)) {
                $nutrient_data[] = [
                    'name' => 'vitamin a',
                    'amount' => 0,
                    'unit' => 'µg',
                ];
            }

            if (!in_array('vitamin c', $required_vitamins_and_minerals)) {
                $nutrient_data[] = [
                    'name' => 'vitamin c',
                    'amount' => 0,
                    'unit' => 'mg',
                ];
            }

            if (!in_array('calcium', $required_vitamins_and_minerals)) {
                $nutrient_data[] = [
                    'name' => 'calcium',
                    'amount' => 0,
                    'unit' => 'mg',
                ];
            }

            if (!in_array('iron', $required_vitamins_and_minerals)) {
                $nutrient_data[] = [
                    'name' => 'iron',
                    'amount' => 0,
                    'unit' => 'mg',
                ];
            }


       
            if (isset($food['foodCategory'])) {
                $food_category_exists = DB::table('food_data_central_categories')
                    ->where('name', $food['foodCategory']['description'])
                    ->first();

                if (empty($food_category_exists)) {
                    DB::table('food_data_central_categories')
                        ->insert([
                            'name' => $food['foodCategory']['description'],
                        ]);
                }
            } else if (isset($food['wweiaFoodCategory'])) {
                $food_category_exists = DB::table('food_data_central_categories')
                    ->where('name', $food['wweiaFoodCategory']['wweiaFoodCategoryDescription'])
                    ->first();

                if (empty($food_category_exists)) {
                    DB::table('food_data_central_categories')
                        ->insert([
                            'name' => $food['wweiaFoodCategory']['wweiaFoodCategoryDescription'],
                        ]);
                }
            } 
            

            $calories_data = collect($nutrient_data)->firstWhere('name', 'calories');

            if (!empty($calories_data)) {
                $food_data['calories'] = $calories_data['amount']; 
                $food_data['calories_unit'] = $calories_data['unit'];
            }
 
            $food_data['nutrients'] = collect($nutrient_data)->filter(function($item) {
                return !empty($item) && isset($item['name']) && $item['name'] != 'calories';
            })->values()->toArray();

           
            $created_food = Food::create($food_data);

            $this->saveNutrientChild($nutrient_data, $created_food->id);

            $this->info('created: ' . $food['description'] . ': ' . $created_food->id);

            
        }

    }


    private function saveNutrientChild($nutrients, $food_id, $nutrient_parent_id = null)
    {
        foreach ($nutrients as $nutrient_row) {

            if (!empty($nutrient_row) && isset($nutrient_row['name']) && isset($nutrient_row['amount']) && isset($nutrient_row['unit'])) {
                $created_nutrient = FoodNutrient::create([
                    'food_id' => $food_id,
                    'parent_nutrient_id' => $nutrient_parent_id,
                    'name' => $nutrient_row['name'],
                    'amount' => $nutrient_row['amount'],
                    'unit' => $nutrient_row['unit'],
                ]);

                if (isset($nutrient_row['composition'])) {
                    $this->saveNutrientChild($nutrient_row['composition'], $food_id, $created_nutrient->id);
                }
            } 
        } 
    }


    private function getNutrient($food_nutrients, $name, $partialMatch = false) 
    {
        $name = strtolower(trim($name)); // Normalize the name
    
        $nutrient = $partialMatch
            ? $food_nutrients->first(fn($item) => isset($item['nutrient']['name']) && strpos(strtolower(trim($item['nutrient']['name'])), $name) !== false)
            : $food_nutrients->first(fn($item) => isset($item['nutrient']['name']) && strtolower(trim($item['nutrient']['name'])) === $name);
        
        return $nutrient ? [
            'name' => isset($nutrient['nutrient']) ? $this->getNutrientName($nutrient['nutrient']['name']) : null,
            'amount' => $nutrient['amount'] ?? null,
            'unit' => strtolower($nutrient['nutrient']['unitName']) ?? null
        ] : null;
    }
    
    
    private function getNutrientName($name)
    {   
        if (isset($this->nutrient_names_mapping[$name])) {
            return $this->nutrient_names_mapping[$name];
        }

        return collect($this->nutrient_names_mapping)->first(function ($value, $key) use ($name) {
            return Str::contains($name, $key);
        });
    }

}
