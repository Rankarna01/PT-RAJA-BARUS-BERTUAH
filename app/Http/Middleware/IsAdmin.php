<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Auth
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN memiliki role 'admin'
        if (Auth::check() && Auth::user()->roles()->where('name', 'admin')->exists()) {
            return $next($request);
        }

        // Jika tidak, tolak akses dengan halaman 403 Forbidden
        abort(403, 'THIS ACTION IS UNAUTHORIZED.');
    }
}