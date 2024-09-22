<?php

namespace App\Http\Controllers\paralux;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function countMethod()
    {
        $cartCount = Panier::count();
        $wishlistCount = Wishlist::count();

        view()->share('cartCount', $cartCount);
        view()->share('wishlistCount', $wishlistCount);

        return $next($request);
    }
}
