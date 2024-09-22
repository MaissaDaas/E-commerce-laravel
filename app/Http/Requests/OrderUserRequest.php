<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'grand_total' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:5000',
            'payment_method' => 'required',
        ];
    }
}
