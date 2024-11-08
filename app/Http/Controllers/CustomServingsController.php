<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomServings;

class CustomServingsController extends Controller
{
    public function __invoke(Request $request, CustomServings $custom_serving_category)
    {
        return $custom_serving_category->servingUnits;
    }
}
