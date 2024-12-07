<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAONutrientContentClaimsCondition;

class FAONutrientContentClaimsController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = FAONutrientContentClaimsCondition::query()->with('referenceValues');

        if ($request->has('component')) {
            $query->where('component', $request->component);
        }

        if ($request->has('food_state')) {
            $query->where('food_state', $request->food_state);
        }

        return $query->get();
    }
}
