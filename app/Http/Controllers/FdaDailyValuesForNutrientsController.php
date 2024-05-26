<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FdaDailyValuesForNutrient;

class FdaDailyValuesForNutrientsController extends Controller
{
    public function __invoke()
    {
        return FdaDailyValuesForNutrient::all();
    }
}
