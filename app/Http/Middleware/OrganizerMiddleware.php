<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna login dan memiliki peran organizer
        if (Auth::check() && Auth::user()->role === 'organizer') {
            return $next($request);
        }

        // Redirect jika pengguna tidak memiliki akses
        return redirect('/')->with('error', 'You are not authorized to access this page.');
    }
}
