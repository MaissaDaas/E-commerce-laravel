<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Models\Brand; 

class AddBrandController extends Controller
{
    public function addbrand()
    {
        return view('dashbord.addbrand');
    }

    public function createbrand(BrandRequest $request)
    {   
        $validated = $request->validated();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $brand = Brand::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'images' => 'images/'. $imageName,
        ]);

        return redirect()->route('addBrandAdmin')->with('success', 'Brand successfully registered');
    }
}
