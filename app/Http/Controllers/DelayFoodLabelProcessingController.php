<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodUpload;

class DelayFoodLabelProcessingController extends Controller
{
    public function store()
    {
        $id = request('id');

        FoodUpload::where('id', $id)
            ->update(['created_at' => now()]);

        return back()
            ->with('alert', ['type' => 'success', 'text' => 'Successfully moved to the end of the queue.']);
    }
}
