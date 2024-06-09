<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFoodUpdateRequest extends FormRequest
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
            'serving_size' => 'required',
            'servings_per_container' => 'required',
          
            'calories' => 'required',

            'food_type' => 'required',
            'origin_country' => 'required',
            'target_age_group' => 'required',
            'allergen_information' => 'nullable',
        ];
    }
}
