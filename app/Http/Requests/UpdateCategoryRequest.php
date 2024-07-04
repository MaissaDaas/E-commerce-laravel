<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|between:2,100',
            'slug' => [
                'string',
                'between:2,100', 
                'regex:/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/',
            ],            
            'description' => 'nullable|string|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }
}
