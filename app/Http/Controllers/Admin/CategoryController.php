<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category; 

class CategoryController extends Controller
{
    public function showcategory()
    {
        $categories = Category::all();
        return view('dashbord.category', compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $validated = $request->validated();

        $category = Category::findOrFail($id);
        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->description = $validated['description'];
        $category->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($category->images && Storage::exists($category->images)) {
                Storage::delete($category->images);
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $category->images = 'images/'.$imageName;
        }

        $category->update();

        return redirect()->route('categoryAdmin')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categoryAdmin');
        //return response()->json('User is deleted');
        // return redirect()->back();
    }
}
