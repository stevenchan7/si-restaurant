<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperadminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_superadmin) {
            return $next($request);
        }

        return redirect('/dashboard'); // Redirect jika bukan superadmin
    }
}

