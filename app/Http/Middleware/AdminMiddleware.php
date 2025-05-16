<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /*
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    */
    
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

   
    /*
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            dd('Admin middleware passed'); // ✅ Add this temporarily
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
     */
}