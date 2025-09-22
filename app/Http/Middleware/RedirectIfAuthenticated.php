<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Mapa de roles y sus rutas correspondientes
            $roleRoutes = [
                'Cliente' => 'cliente.dashboard',
                'Administrador' => 'administrador.dashboard',
                'Empleado' => 'empleado.dashboard',
            ];

            // Buscar la primera ruta correspondiente al rol del usuario
            foreach ($roleRoutes as $role => $route) {
                if ($user->hasRole($role)) {
                    return redirect()->route($route);
                }
            }
        }

        return $next($request);
    }
}
