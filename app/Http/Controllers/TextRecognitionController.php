<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodUpload;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image;
use Illuminate\Support\Facades\Http;

class TextRecognitionController extends Controller
{
    public function __invoke()
    {
        $upload_id = request('id');
        $source = request('source');
        $food_upload = FoodUpload::where('id', $upload_id)->first();

        if ($source === 'ingredients') {
            $imageAnnotator = new ImageAnnotatorClient([
                'credentials' => json_decode(file_get_contents(storage_path('app/pinoy-food-52358a6a6b1c.json')), true),
            ]);
            
            $field = $food_upload->ingredients_image;
            $imagePath = storage_path('app/public/' . $field);
        
            $imageContent = file_get_contents($imagePath);
        
            $image = (new Image())->setContent($imageContent);
        
            $response = $imageAnnotator->textDetection($image);
            $texts = $response->getTextAnnotations();
            
            $all_text = '';
            foreach ($texts as $text) {
                $all_text .= $text->getDescription() . "\n";
            }

            return $all_text;
        }


        $endpoint = 'https://api.openai.com/v1/chat/completions';

        $sample_json = [
            'calories' => '20kcal',
            'serving_size' => '56g',
            'servings_per_container' => 3,
            'nutrients' => [
                [
                    'name' => 'total carbohydrates',
                    'value' => '20g',
                    'child' => [
                        [
                            'name' => 'dietary fiber',
                            'value' => '16g',
                            'child' => [
                                [
                                    'name' => 'soluble',
                                    'value' => '14g',
                                ],
                                [
                                    'name' => 'insoluble',
                                    'value' => '2g',
                                ]
                            ]
                        ],
                        
                        [
                            'name' => 'sugar',
                            'value' => '4g',
                        ]
                    ]
                ],
                
                [
                    'name' => 'total fat',
                    'value' => '6g',
                    'child' => [
                        [
                            'name' => 'saturated fat',
                            'value' => '1g'
                        ],
                        [
                            'name' => 'trans fat',
                            'value' => 0,
                        ],
                        [
                            'name' => 'unsaturated fat',
                            'value' => '4g',
                        ],
                        [
                            'name' => 'cholesterol',
                            'value' => 0,
                        ],
                        [
                            'name' => 'polyunsaturated fat',
                            'value' => '1g',
                            'child' => [
                                [
                                    'name' => 'dha',
                                    'value' => '0.5g',
                                ],
                                [
                                    'name' => 'omega 3',
                                    'value' => '0.2g',
                                ],
                                [
                                    'name' => 'omega 6',
                                    'value' => '0.1g',
                                ]
                            ]
                        ]
                    ]
                ],
                
                [
                    'name' => 'protein',
                    'value' => '20g',
                ],
    
           
    
                [
                    'name' => 'vitamin a',
                    'value' => '1IU',
                ],
                [
                    'name' => 'vitamin c',
                    'value' => '2mg',
                ],
                [
                    'name' => 'vitamin d',
                    'value' => '3mg',
                ],
                [
                    'name' => 'vitamin b1',
                    'value' => '4mg',
                ],
                [
                    'name' => 'vitamin b2',
                    'value' => '5mg',
                ],
                [
                    'name' => 'vitamin b3',
                    'value' => '6mg',
                ],
                [
                    'name' => 'vitamin b5',
                    'value' => '7mg',
                ],
                [
                    'name' => 'vitamin b6',
                    'value' => '8mg',
                ],
                [
                    'name' => 'vitamin b7',
                    'value' => '9mg',
                ],
                [
                    'name' => 'vitamin b9',
                    'value' => '10mg',
                ],
                [
                    'name' => 'vitamin b12',
                    'value' => '11mg',
                ],
                [
                    'name' => 'vitamin e',
                    'value' => '12mg',
                ],
                [
                    'name' => 'vitamin k',
                    'value' => '13mg',
                ],
    
    
                [
                    'name' => 'sodium',
                    'value' => '1mg',
                ],
                [
                    'name' => 'chloride',
                    'value' => '2mg',
                ],
                [
                    'name' => 'potassium',
                    'value' => '3mg',
                ],
                [
                    'name' => 'magnesium',
                    'value' => '4mg',
                ],
                [
                    'name' => 'zinc',
                    'value' => '5mg',
                ],
                [
                    'name' => 'iron',
                    'value' => '6mg',
                ],
                [
                    'name' => 'selenium',
                    'value' => '7mg',
                ],
                [
                    'name' => 'copper',
                    'value' => '8mg',
                ],
                [
                    'name' => 'manganese',
                    'value' => '9mg', 
                ],
                [
                    'name' => 'phosphorus',
                    'value' => '10mg',
                ],
                [
                    'name' => 'calcium',
                    'value' => '11mg',
                ],
                [
                    'name' => 'iodine',
                    'value' => '12mg',
                ],
    
                [
                    'name' => 'chromium',
                    'value' => '13mg',
                ],
                [
                    'name' => 'molybdenum',
                    'value' => '14mg'
                ],
                [
                    'name' => 'fluoride',
                    'value' => '15mg'
                ],
            ] 
        ];
    
        $data = [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            "type" => "text",
                            "text" => "extract the text from the image and present it in the following json format: " . json_encode($sample_json) .  " extract all relevant nutrition information from the image, not just the ones in the sample json. If a nutrition in the sample json does not have a match in the image, exclude it from the output."
                        ],
                        [
                            "type" => "image_url",
                            "image_url" => [ 
                                "url" => url("/storage/" . $food_upload->nutrition_label_image)
                            ]
                        ]
                    ],
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
                info($response_data);
                return $response_data;
            }

        } catch (\Exception $e) {
            return $e->getMessage();    
        }

    }
}
