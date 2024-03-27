<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFoodLabelUploadRequest extends FormRequest
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
            'title_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5000', 
            'title' => 'required',
            'barcode_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5000',
            'barcode' => 'required',
            'nutrition_label_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5000',
        ];
    }
}
