<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /* Manejar una solicitud entrante */
    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) { 
            return redirect('/');
        }

        return $next($request);
    }
}
