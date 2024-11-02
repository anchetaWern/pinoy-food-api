<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomServingsCategory;

class CustomServingsController extends Controller
{
    public function __invoke(Request $request, CustomServingsCategory $custom_serving_category)
    {
        return $custom_serving_category->servingUnits;
    }
}
