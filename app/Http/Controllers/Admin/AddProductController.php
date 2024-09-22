<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Brand;
use App\Models\Product; 
use App\Http\Requests\ProductRequest;

class AddProductController extends Controller
{
    public function addproduct()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('dashbord.addproduct', compact('categories', 'brands'));
    }

    public function createproduct(ProductRequest $request)
    {   
        $validated = $request->validated();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $product = Product::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            // 'brand_id'=>1,
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'],
            'discount_amount' => $validated['discount_amount'],
            'images' => 'images/'. $imageName,
        ]);

        return redirect()->route('addProductAdmin')->with('success', 'Product successfully registered');
    }

}
