<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Food;
use App\Models\FoodType;
use App\Models\FoodState;

class AddAIFoodTypesAndFoodStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-food-types';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds the food types and food states to foods';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $food_states = json_encode(json_decode(file_get_contents(storage_path('app/physical-state-food-categories.json')), true));
        $food_types = json_encode(json_decode(file_get_contents(storage_path('app/food-subtypes.json')), true));

        $sample_response = json_encode(['foods' => [
            [
                'food' => '',
                'type' => 'Prepared and Processed',
                'subtype' => 'Canned Seafood',
                'state' => 'solids',
                'substate' => ''
            ]
        ]]);
       
        $foods_to_update = Food::whereNull('food_subtype')
            ->whereRaw("DATE(updated_at) < ?", [now()->toDateString()])
            ->take(50);
       
        // $foods_to_update = Food::where('food_subtype', 0)->take(79);

        $food_list_r = $foods_to_update->pluck('description')->values()->toArray();
      
        $food_list = implode("|", $food_list_r);
     
        $prompt = "Given the following food states: " . $food_states . " and food types: " . $food_types . ", classify the following foods: " . $food_list . ". Use the following json format: " . $sample_response . " For the food type, select a type first then select a subtype under the selected type. Categorize based on its nutrition. If its not a whole food, set its type to Prepared and Processed. If the state is Liquids, also set the substate";
    
        $updated_ids = $foods_to_update->pluck('id')->values()->toArray();

        info($updated_ids);
      
        Food::whereIn('id', $updated_ids)
            ->update([
                'food_subtype' => 0
            ]);
       
        $endpoint = 'https://api.openai.com/v1/chat/completions';

        $data = [
            'model' => config('services.chatgpt.model'),
            'temperature' => 0.3,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ]
            ],
            'response_format' => [
                'type' => 'json_object',
            ],
        ];
        

        try {
            $response = Http::timeout(300)->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . config('services.chatgpt.secret'),
            ])->post($endpoint, $data);

            $result = $response->json();

            if (isset($result['choices']) && !empty($result['choices'])) {
              
                $response_data = json_decode($result['choices'][0]['message']['content'], true);
             
                info($result['choices'][0]['message']['content']);

                foreach ($response_data['foods'] as $food_with_types) {
                    
                    $has_subtype = isset($food_with_types['subtype']) && !is_null($food_with_types['subtype']);
                    $has_substate = isset($food_with_types['substate']) && !is_null($food_with_types['substate']);

                    $food_name = $food_with_types['food'];
                    $food_type = $food_with_types['type'];
                    $food_subtype = $has_subtype ? $food_with_types['subtype'] : null;
                    $food_state = $food_with_types['state'];
                    $food_substate = $has_substate ? $food_with_types['substate'] : null;
                    
                    $food_type_id = FoodType::where('name', $food_type)->value('id');

                    $food_subtype_id = null; 
                    if ($has_subtype) {
                        $food_subtype_id = FoodType::where('name', $food_subtype)->value('id');
                    }
                  
                    $food_state_id = FoodState::where('name', $food_state)->value('id');
                    
                    $food_substate_id = null; 
                    if ($has_substate) {
                        $food_substate_id = FoodState::where('name', $food_substate)->value('id');
                    }


                    Food::where('description', $food_name)
                        ->update([
                            'food_type' => $food_type_id,
                            'food_subtype' => $food_subtype_id,
                            'food_state' => $food_state_id,
                            'food_substate' => $food_substate_id,
                        ]);
                }
            } 
            

        } catch (\Exception $e) {
            info('chatgpt error: ' . $e->getMessage());
        }
        
        
    }
}
