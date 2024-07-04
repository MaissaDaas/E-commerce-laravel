<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
                'regex:/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/',
            ],            
            'description' => 'required|nullable|string|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'price' => 'required|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
