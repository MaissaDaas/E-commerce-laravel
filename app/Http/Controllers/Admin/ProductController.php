<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category; 
use App\Models\Brand; 
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function showproduct()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('dashbord.product', compact('products', 'categories', 'brands'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($id);
        $product->name = $validated['name'];
        $product->slug = $validated['slug'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->category_id = $validated['category_id'];
        $product->brand_id = $validated['brand_id'];
        $product->discount_amount = $validated['discount_amount'];
        $product->is_active = $request->has('is_active') ? 1 : 0;
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->in_stock = $request->has('in_stock') ? 1 : 0;
        $product->on_sale = $request->has('on_sale') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($product->images && Storage::exists($product->images)) {
                Storage::delete($product->images);
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->images = 'images/'.$imageName;
        }

        $product->save();

        return redirect()->route('productAdmin')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('productAdmin');
    }
}
