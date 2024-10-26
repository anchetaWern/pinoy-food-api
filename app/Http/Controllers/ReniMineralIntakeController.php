<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReniMineralIntake;

class ReniMineralIntakeController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = ReniMineralIntake::query();

        $gender = $request->has('gender') ? $request->gender : null;
        
    
        if ($request->age) {
                    
            $age = $request->age;
            $age_type = $request->has('age_type') ? $request->age_type : 'year';
            
            $res = $query
                ->where('age_type', $age_type)
                ->where('age_from', '<=', $age)
                ->where(function ($query) use ($age) {
                    $query->where('age_to', '>=', $age)
                        ->orWhereNull('age_to');
                });
    
            if ($gender) {
                $res = $res->select(array_merge(
                    ReniMineralIntake::UNGENDERED_FIELDS,
                    $gender === 'male' ? ReniMineralIntake::MALE_FIELDS : ReniMineralIntake::FEMALE_FIELDS
                ));
            }
    
            return $res->first();
            
        }
    
        if ($gender) {
            return $query->select(array_merge(
                ReniMineralIntake::UNGENDERED_FIELDS,
                $gender === 'male' ? ReniMineralIntake::MALE_FIELDS : ReniMineralIntake::FEMALE_FIELDS
            ))
            ->get();
        }
    
        return $query->get();
    
    }
}
