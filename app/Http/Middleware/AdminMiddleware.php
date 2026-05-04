<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Daftar email yang memiliki akses Admin
        $admins = ['admin@gmail.com', 'admin@arguecraft.com'];

        if (Auth::check() && in_array(Auth::user()->email, $admins)) {
            return $next($request);
        }

        // Jika bukan admin, tendang balik ke dashboard biasa dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Admin.');
    }
}
