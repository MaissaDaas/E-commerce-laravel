<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\addCategory;
use App\Http\Requests\CategoryRequest;
use App\Models\Category; 

class AddCategoryController extends Controller
{
    public function addcategory()
    {
        return view('dashbord.addCategory');
    }

    public function createcategory(CategoryRequest $request)
    {   
        $validated = $request->validated();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
            'images' => 'images/'. $imageName,
            // 'image' => $request->hasFile('image') ? $request->file('image')->store('categories', 'public') : null,
        ]);

        return redirect()->route('dashbord.addCategory')->with('success', 'User successfully registered');
    }


    // <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
}
