<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddresseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'phone' => 'required|numeric|min:8',
            'street_address' => 'required|string|max:5000',
            'city' => 'required|string|max:5000',
            'state' => 'required|string|max:5000',
            'zip_code' => 'required|numeric|min:4',
        ];
    }
}
