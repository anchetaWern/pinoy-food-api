<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCreateFoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required', 
            'calories' => 'required|numeric',
            'calories_unit' => 'required|in:kcal,cal,kj,j',
            'serving_size' => 'nullable|numeric',
            'serving_size_unit' => 'nullable|in:g,ml,cups,pcs,tsp,tbsp,slices',
            'servings_per_container' => 'nullable|numeric',
            'ingredients' => 'nullable',
            'nutrients' => 'required|json',
        ];
    }
}

/* 
[{"name": "Protein", "amount": 0.7, "unit": "g"},{"name": "Potassium", "amount": 263.9, "unit": "mg"},{"name": "Fat", "amount": 0.4, "unit": "g"},{"name": "Sodium", "amount": 11.6, "unit": "mg"}, {"name": "Carbohydrates", "amount": 16, "unit": "g", "composition": [{"name": "Fiber", "amount": 2.5, "unit": "g"},{"name": "Sugars", "amount": 11, "unit": "g"}]}]
*/