<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPelanggan
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user login dan memiliki role 'user'
        if (Auth::check() && Auth::user()->roles()->where('name', 'user')->exists()) {
            return $next($request);
        }
        
        // Jika bukan, tolak akses atau arahkan ke tempat lain (misal: dashboard admin)
        // Atau jika admin, arahkan ke dashboard admin
        if(Auth::check() && Auth::user()->roles()->where('name', 'admin')->exists()){
            return redirect()->route('admin.dashboard');
        }

        // Jika tidak memenuhi keduanya, logout saja untuk keamanan
        Auth::logout();
        return redirect('/login')->with('error', 'Akses tidak diizinkan.');
    }
}