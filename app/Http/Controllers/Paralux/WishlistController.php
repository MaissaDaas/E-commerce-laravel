<?php

namespace App\Http\Controllers\paralux;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist; 
use App\Models\Product; 
use App\Models\Category; 
use App\Models\Brand; 
use App\Http\Requests\WishlistRequest;


class WishlistController extends Controller
{
    public function showwishlist()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $products = Product::all();
            $wishlists = $user->wishlists()->with('product.brand')->get();
            $categories = Category::all();
            $brands = Brand::all();

            return view('paralux.wishlist', compact('wishlists','brands','categories','products'));
        }else {
            return redirect()->route('login_form')->with('error', 'Vous devez être connecté pour voir votre panier.');
        }
    }

    public function addwishlist(WishlistRequest $request)
    {
        $validated = $request->validated();

        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'You need to be logged in to add items to your wishlist.']);
        }

        $userId = auth()->id();
        $wishlistItem = Wishlist::where('product_id', $validated['product_id'])
            ->where('user_id', $userId)
            ->first();

        if ($wishlistItem) {
            return response()->json(['success' => true, 'message' => 'Product already in your wishlist']);
        } else {
            Wishlist::create([
                'product_id' => $validated['product_id'],
                'user_id' => $userId,
            ]);
            \Log::info('Product added to Wishlist', ['product_id' => $validated['product_id'], 'user_id' => $userId]);
        }

        return response()->json(['success' => true, 'message' => 'Product successfully added to wishlist']);
    }

    public function destroy($id)
    {
        $Wishlist = Wishlist::findOrFail($id);
        $Wishlist->delete();
        return redirect()->route('showwishlist');
    }

}
