<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Panier;
use App\Models\Wishlist;

class ShareCounts
{
    public function handle(Request $request, Closure $next)
    {
        $cartCount = 0;
        $wishlistCount = 0;

        if (Auth::check()) {
            $user = Auth::user();
            
            $cartCount = Panier::where('user_id', $user->id)->count();
            $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        }

        view()->share('cartCount', $cartCount);
        view()->share('wishlistCount', $wishlistCount);

        return $next($request);

        // $cartCount = Panier::count();
        // $wishlistCount = Wishlist::count();

        // view()->share('cartCount', $cartCount);
        // view()->share('wishlistCount', $wishlistCount);

        // return $next($request);
    }
}
