<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                'unique:categories', 
                'regex:/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/',
            ],            
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }
}
