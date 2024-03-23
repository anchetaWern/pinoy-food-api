<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReniMacronutrientDistribution;

class ReniMacronutrientDistributionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = ReniMacronutrientDistribution::query();

        if ($request->age_type && $request->age) {
                    
            $age = $request->age;

            return $query
                ->where('age_type', $request->age_type)
                ->where('age_from', '<=', $age)
                ->where(function ($query) use ($age) {
                    $query->where('age_to', '>=', $age)
                        ->orWhereNull('age_to');
                })
                ->first();
            
        }

        return $query->get();
    }
}
