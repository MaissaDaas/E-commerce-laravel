<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PanierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            // 'unit_amount' => 'required|numeric|min:0',
            // 'total_amount' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
        ];
    }
}
