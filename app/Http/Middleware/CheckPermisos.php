<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermisos
{
    public function handle(Request $request, Closure $next, $permiso)
    {
        $permisosRequeridos = explode('|', $permiso); 
        $usuario = Auth::user();
        $permisosUsuario = json_decode($usuario->rol->permisos ?? '[]', true);

        foreach ($permisosRequeridos as $p) {            
            if (in_array($p, $permisosUsuario)) {
                return $next($request); // si tiene al menos uno, continúa
            }
        }

        abort(403, 'No tienes permiso para acceder a esta sección.');
    }
}

