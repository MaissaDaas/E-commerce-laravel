<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //Un middleware est une couche intermédiaire qui traite les requêtes HTTP avant qu'elles n'atteignent le contrôleur de l'application. Le but de ce middleware particulier est de vérifier si l'utilisateur actuel est un administrateur.
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == 'admin'){
            return $next($request);
        }else {
            return response()->json('you are not an admin');
        }
        
    }
}
