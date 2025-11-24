<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'car_id' => 'required|integer|exists:cars,id',
            'user_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'car_id.required' => 'The car field is required.',
            'user_id.required' => 'The user field is required.',
            'start_date.required' => 'The start date field is required.',
            'end_date.required' => 'The end date field is required.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'car_id.exists' => 'The selected car does not exist.',
            'user_id.exists' => 'The selected user does not exist.',
        ];
    }
}

