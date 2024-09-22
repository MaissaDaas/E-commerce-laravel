<?php

namespace App\Http\Controllers\Paralux;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category; 
use App\Models\Brand; 

class HomeController extends Controller
{
    public function showhome()
    {
        $products = Product::with('category')
            ->where('is_active', 1)
            ->where('in_stock', 1)
            ->get();
        $categories = Category::all();
        $brands = Brand::all();

        $visageCategory = Category::where('slug', 'visage')->first();
        $visageProducts = collect();
        if ($visageCategory) {
            $visageProducts = $visageCategory->products()->where('is_active', 1)->take(4)->get();
        }

        $cheveuxCategory = Category::where('slug', 'cheveux')->first();
        $cheveuxProducts = collect();
        if ($cheveuxCategory) {
            $cheveuxProducts = $cheveuxCategory->products()->where('is_active', 1)->take(4)->get();
        }

        $corpsCategory = Category::where('slug', 'corps')->first();
        $corpsProducts = collect();
        if ($corpsCategory) {
            $corpsProducts = $corpsCategory->products()->where('is_active', 1)->take(4)->get();
        }

        return view('paralux.home',  compact('products', 'categories', 'brands', 'visageProducts', 'cheveuxProducts', 'corpsProducts'));    
    }

    public function showboutique(Request $request, $category = null)
    {
        $query = Product::with('category', 'brand')->where('is_active', 1);
    
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }
    
        if ($request->has('brand_id') && !empty($request->input('brand_id'))) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            if ($sortBy == 'LowToHigh') {
                $query->orderBy('price', 'asc');
            } elseif ($sortBy == 'HighToLow') {
                $query->orderBy('price', 'desc');
            }
        }
    
        $products = $query->get();
        $totalProducts = $query->count();

        $categories = Category::all();
        $brands = Brand::all();
    
        return view('paralux.boutique', compact('products', 'categories', 'brands', 'totalProducts'));
    }
    
    public function loadMoreProducts(Request $request)
    {
        $offset = $request->input('offset', 15);
        $category = $request->input('category', null);
        $brandId = $request->input('brand_id', null);
        $sortBy = $request->input('sort_by', null);

        $query = Product::with('category', 'brand')->where('is_active', 1);

        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        if ($sortBy) {
            if ($sortBy == 'LowToHigh') {
                $query->orderBy('price', 'asc');
            } elseif ($sortBy == 'HighToLow') {
                $query->orderBy('price', 'desc');
            }
        }

        // Fetch the next set of products
        $products = $query->skip($offset)->take(5)->get();

        return response()->json($products);
    }

    public function showmarque()
    {
        $brands = Brand::all();
        return view('paralux.marque', compact('brands')); 
    }

    public function showviewmodal()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('paralux.home',  compact('products', 'categories', 'brands'));    
    }

    public function showVisageProducts() 
    {
        $categorySlug = 'visage';
        $category = Category::where('slug', $categorySlug)->first();
    
        if ($category) {
            $products = $category->products()->take(4)->get();
        } else {
            $products = collect(); 
        }
    
        return view('paralux.productBox', compact('products'));
    }

    public function getSimilarProducts($product, $limit = 5)
    {
        return Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', 1)
            ->take($limit)
            ->get();
    }

    public function viewProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->description = nl2br(str_replace('-', "\n", $product->description));
        $categories = Category::all();
        $brands = Brand::all();
        $similarProducts = $this->getSimilarProducts($product);
        return view('paralux.viewProduct', compact('product', 'categories', 'brands', 'similarProducts'));
    }

    public function showventeflash(Request $request, $category = null)
    {
        $query = Product::with('category', 'brand')->where('is_active', 1);

        if ($request->has('brand_id') && !empty($request->input('brand_id'))) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            if ($sortBy == 'LowToHigh') {
                $query->orderBy('price', 'asc');
            } elseif ($sortBy == 'HighToLow') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->get();

        $products = Product::with('category')
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->get();
        $totalProducts = $query->count();

        $categories = Category::all();
        $brands = Brand::all();

        return view('paralux.venteflash', compact('products', 'categories', 'brands', 'totalProducts'));   
    }

}