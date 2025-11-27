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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}

