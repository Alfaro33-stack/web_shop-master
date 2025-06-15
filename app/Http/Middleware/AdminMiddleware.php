<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->rol !== 'admin') {
            return redirect()->route('home')->with('error', 'No tienes permisos de administrador');
        }

        return $next($request);
    }
} 