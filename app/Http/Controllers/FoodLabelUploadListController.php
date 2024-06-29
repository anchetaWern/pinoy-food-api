<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodUpload;
use Yajra\Datatables\Datatables;

class FoodLabelUploadListController extends Controller
{
    public function index()
    {
        return view('food-label-uploads');
    }


    public function data()
    {
        $food_uploads = FoodUpload::query();

        return Datatables::of($food_uploads)
            ->editColumn('title_image', function ($model) {
                return '<button class="btn btn-secondary btn-sm view-image" data-title="Title/Food Image" data-url="' . url('storage/' . $model->title_image) . '">View</button>';
            })
            ->editColumn('nutrition_label_image', function ($model) {
                $nutrition_label_image = ($model->nutrition_label_image) ? url('storage/' . $model->nutrition_label_image) : '';
                return '<button class="btn btn-secondary btn-sm view-image" data-title="Nutrition label Image" data-url="' . $nutrition_label_image . '">View</button>';
            })
            ->editColumn('ingredients_image', function ($model) {
                $ingredients_image = ($model->ingredients_image) ? url('storage/' . $model->ingredients_image) : '';
                return '<button class="btn btn-secondary btn-sm view-image" data-title="Ingredients Image" data-url="' . $ingredients_image . '">View</button>';
            })
            ->editColumn('barcode_image', function ($model) {
                $barcode_image = ($model->barcode_image) ? url('storage/' . $model->barcode_image) : '';
                return '<button class="btn btn-secondary btn-sm view-image" data-title="Barcode Image" data-url="' . $barcode_image . '">View</button>';
            })

            ->editColumn('id', function ($model) {
               return '<a href="/foods/create/' . $model->id . '">Review</a>';
            })

            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($model) {
                return $model->updated_at->format('Y-m-d');
            })
           
            ->rawColumns(['title_image', 'nutrition_label_image', 'ingredients_image', 'barcode_image', 'id'])
            ->make(true);  
    }


}
