<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReniEnergyIntake;

class ReniEnergyIntakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        $query = ReniEnergyIntake::query();

        if ($request->age_type && $request->age) {
                    
            return $query
                ->where('age_type', $request->age_type)
                ->where('age_from', '>=', $request->age)
                ->first();
            
        }

        return $query->get();
    }
}
