<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodType;

class FoodTypesController extends Controller
{
    public function __invoke(Request $request)
    {   
        return FoodType::get();
    }
}
