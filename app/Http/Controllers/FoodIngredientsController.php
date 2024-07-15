<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodIngredientsController extends Controller
{
    public function __invoke(Food $food)
    {
        return $food->ingredientsInfo;
    }
}
