<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodUpload;
use App\Http\Requests\ValidateFoodLabelUploadRequest;
use Str;
use Illuminate\Support\Facades\Storage;

class FoodLabelUploadController extends Controller
{

    private function getExtensionFromMimeType($mime_type)
    {
        switch ($mime_type) {
            case 'jpeg':
            case 'jpg':
                return 'jpg';
            case 'png':
                return 'png';
            case 'gif':
                return 'gif';
           
            default:
                return 'jpg'; 
        }
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(ValidateFoodLabelUploadRequest $request)
    {
        $title = Str::random(40); 

        // title
        $title_image = $request->input('title_image');
        preg_match('/^data:image\/(\w+);base64,/', $title_image, $title_image_matches);
        $title_image_mime_type = $title_image_matches[1] ?? null;
        $title_image_extension = $this->getExtensionFromMimeType($title_image_mime_type);

        $title_image_data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $title_image), true);

        // ingredients
        if ($request->has('ingredients_image') && trim($request->input('ingredients_image')) !== '') {
            $ingredients_image = $request->input('ingredients_image');
            preg_match('/^data:image\/(\w+);base64,/', $ingredients_image, $ingredients_image_matches);
            $ingredients_image_mime_type = $ingredients_image_matches[1] ?? null;
            $ingredients_image_extension = $this->getExtensionFromMimeType($ingredients_image_mime_type);
            
            $ingredients_image_data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $ingredients_image), true);
        }

        // barcode
        $image_barcode = null;
        if ($request->has('barcode_image') && trim($request->input('barcode_image')) !== '') {
            $barcode_image = $request->input('barcode_image');
            preg_match('/^data:image\/(\w+);base64,/', $barcode_image, $barcode_image_matches);
            $barcode_image_mime_type = $barcode_image_matches[1] ?? null;
            $barcode_image_extension = $this->getExtensionFromMimeType($barcode_image_mime_type);

            $barcode_image_data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $barcode_image), true);
        }

        // nutrition label
        $nutrilabel_image = $request->input('nutrition_label_image');
        preg_match('/^data:image\/(\w+);base64,/', $nutrilabel_image, $nutrilabel_image_matches);
        $nutrilabel_image_mime_type = $nutrilabel_image_matches[1] ?? null;
        $nutrilabel_image_extension = $this->getExtensionFromMimeType($nutrilabel_image_mime_type);

        $nutrilabel_image_data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $nutrilabel_image), true);

        $image_title = Str::slug(now()->format('Y-m-d H:i') . '-title-' . $title) . '.' . $title_image_extension;
        Storage::disk('public')->put($image_title, $title_image_data);

        $image_ingredients = null;
        if ($request->has('ingredients_image') && trim($request->input('ingredients_image')) !== '') {
            info('has ingredients image: ');
            info($request->input('ingredients_image'));

            $image_ingredients = Str::slug(now()->format('Y-m-d H:i') . '-ingredients-' . $title) . '.' . $ingredients_image_extension;
            Storage::disk('public')->put($image_ingredients, $ingredients_image_data);
        }

        if ($request->has('barcode_image') && trim($request->input('barcode_image')) !== '') {
            info('has barcode image: ');
            info($request->input('barcode_image'));

            $image_barcode = Str::slug(now()->format('Y-m-d H:i') . '-barcode-' . $title) . '.' . $barcode_image_extension;
            Storage::disk('public')->put($image_barcode, $barcode_image_data);
        }

        $image_nutrilabel = Str::slug(now()->format('Y-m-d H:i') . '-nutrilabel-' . $title) . '.' . $nutrilabel_image_extension;
        Storage::disk('public')->put($image_nutrilabel, $nutrilabel_image_data);

        $food_upload = FoodUpload::create([
            'title_image' => $image_title, 
            'title' => $title,
            'barcode_image' => $image_barcode,
            'nutrition_label_image' => $image_nutrilabel,
            'ingredients_image' => $image_ingredients,
        ]);
       
        return response()->json(
            $food_upload
        , 201)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        
        
    }
}
