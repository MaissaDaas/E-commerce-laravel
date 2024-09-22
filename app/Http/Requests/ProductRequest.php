<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|between:2,100',
            'slug' => [
                'required',
                'string',
                'between:2,100',
                'unique:products', 
                'regex:/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/',
            ],            
            'description' => 'nullable|string|max:5000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'price' => 'required|numeric|min:0',
            'discount_amount' => 'numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ];
    }
}
