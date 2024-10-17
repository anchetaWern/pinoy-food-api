<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PDRIVitaminIntake;

class PDRIVitaminIntakeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = PDRIVitaminIntake::query();

        if ($request->age) {
                    
            $age = $request->age;
            $age_type = $request->has('age_type') ? $request->age_type : 'year';

            return $query
                ->where('age_type', $age_type)
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
