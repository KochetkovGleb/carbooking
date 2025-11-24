<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'brand.required' => 'The brand field is required.',
            'model.required' => 'The model field is required.',
            'price_per_day.required' => 'The price per day field is required.',
            'price_per_day.numeric' => 'The price per day must be a number.',
            'price_per_day.min' => 'The price per day must be at least 1.',
        ];
    }
}
