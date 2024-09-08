<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Additive;
use App\Models\AdditiveFunctionName;
use App\Models\AdditiveFunction;

class AdditivesController extends Controller
{
    public function index()
    {
        if (request()->has('query')) {
            $query = request('query');

            return Additive::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('INS', 'LIKE', '%' . $query . '%')
                ->with('functions')
                ->first();
        }

        return Additive::with('functions')->paginate(10);
    }

}
