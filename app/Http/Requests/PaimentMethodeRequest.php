<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaimentMethodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => 'required|in:Paiement à la livraison,Credit Card,PayPal,Stripe,Bank Transfer',
        ];
    }
}
