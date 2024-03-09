<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateCreateFoodRequest;
use App\Http\Requests\ValidateUpdateFoodRequest;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('query')) {
            $query = request('query');
            return Food::where('description', 'LIKE', '%' . $query . '%')->get();
        }

        return Food::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateCreateFoodRequest $request)
    {
        $food = $request->validated();
        $food['nutrients'] = json_decode($food['nutrients']);
        return Food::create($food);
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return $food;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateUpdateFoodRequest $request, Food $food)
    {   
        $data = $request->validated();
        $data['nutrients'] = json_decode($data['nutrients'], true);
        $food->update($data);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return 'deleted';
    }
}
