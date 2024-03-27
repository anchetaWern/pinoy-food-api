<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodUpload;
use App\Http\Requests\ValidateFoodLabelUploadRequest;
use Str;

class FoodLabelUploadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ValidateFoodLabelUploadRequest $request)
    {
        $title_image = $request->file('title_image');
        $title = $request->input('title');

        $barcode_image = $request->file('barcode_image');
        $barcode = $request->input('barcode');

        $nutrilabel_image = $request->file('nutrition_label_image');

        $image_title = Str::slug(now()->format('Y-m-d H:i') . '-title-' . $title) . '.' . $title_image->getClientOriginalExtension();
        $title_image->move(storage_path('app/food_labels/'), $image_title);

        $image_barcode = Str::slug(now()->format('Y-m-d H:i') . '-barcode-' . $barcode) . '.' . $barcode_image->getClientOriginalExtension();
        $barcode_image->move(storage_path('app/food_labels/'), $image_barcode);

        $image_nutrilabel = Str::slug(now()->format('Y-m-d H:i') . '-nutrilabel-' . $barcode) . '.' . $nutrilabel_image->getClientOriginalExtension();
        $nutrilabel_image->move(storage_path('app/food_labels/'), $image_nutrilabel);

        $food_upload = FoodUpload::create([
            'title_image' => $image_title, 
            'title' => $title,
            'barcode_image' => $image_barcode,
            'barcode' => $barcode,
            'nutrition_label_image' => $image_nutrilabel,
        ]);
       
        return response()->json(
            $food_upload
        , 201);
        
        
    }
}
