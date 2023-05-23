<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado y tiene el rol adecuado
        if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('trabajador'))) {
            return $next($request);
        }

        // Redirigir a una página de acceso no autorizado
        return redirect('/')->with('error', 'Acceso no autorizado.');
    }
}
