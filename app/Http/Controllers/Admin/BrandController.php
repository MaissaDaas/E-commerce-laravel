<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand; 
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function showbrand()
    {
        $brands = Brand::all();
        return view('dashbord.brand', compact('brands'));
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $validated = $request->validated();

        $brand = Brand::findOrFail($id);
        $brand->name = $validated['name'];
        $brand->slug = $validated['slug'];
        $brand->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($brand->images && Storage::exists($brand->images)) {
                Storage::delete($brand->images);
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $brand->images = 'images/'.$imageName;
        }

        $brand->update();

        return redirect()->route('brandAdmin')->with('success', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route('brandAdmin');
        //return response()->json('User is deleted');
        // return redirect()->back();
    }
}
