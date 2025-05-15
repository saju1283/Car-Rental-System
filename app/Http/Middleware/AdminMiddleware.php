<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}