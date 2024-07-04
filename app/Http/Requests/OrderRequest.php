<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:new,processing,shipped,delivered,canceled',
            'payment_status' => 'required|in:Paid,Pending,Failed,Refunded,Canceled,Authorized,Partially Paid',
        ];
    }
}
