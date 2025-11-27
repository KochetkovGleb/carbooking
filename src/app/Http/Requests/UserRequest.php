<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:40|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Ошибка валидации',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }

}
