<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUpdateFoodRequest extends FormRequest
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
            'description' => 'required|string',
            'calories' => 'nullable|numeric',
            'calories_unit' => 'nullable|in:kcal,cal,kj,j',
            'serving_size' => 'nullable|numeric',
            'serving_size_unit' => 'nullable|in:g,ml,cups,pcs,tsp,tbsp,slices',
            'servings_per_container' => 'nullable|numeric',
            'nutrients' => 'nullable|json',
            'allergen_information' => 'nullable',
        ];
    }
}
