<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 

class CategoryController extends Controller
{
    public function showcategory()
    {
        $categories = Category::all();
        return view('dashbord.category', compact('categories'));
    }
}
