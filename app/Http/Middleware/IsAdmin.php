<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kullanıcının giriş yapmış ve admin olup olmadığını kontrol et
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Eğer admin değilse, ana sayfaya yönlendir
        return redirect('/')->with('error', 'Bu sayfaya erişim yetkiniz yok.');
    }
}
