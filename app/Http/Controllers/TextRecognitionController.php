<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodUpload;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image;

class TextRecognitionController extends Controller
{
    public function __invoke()
    {
        $source = request('source');
        $food_upload = FoodUpload::orderBy('created_at', 'ASC')->first();

        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => json_decode(file_get_contents(storage_path('app/pinoy-food-52358a6a6b1c.json')), true),
        ]);
        
        $field = $source === 'nutrition' ? $food_upload->nutrition_label_image : $food_upload->ingredients_image;
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
}
