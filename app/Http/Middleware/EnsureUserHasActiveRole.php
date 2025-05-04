<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasActiveRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Si no está autenticado, dejamos que el middleware de auth lo maneje
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        
        // Verificar si el usuario tiene al menos un rol activo
        $hasActiveRoles = $user->roles()->where('estado', true)->exists();
        
        if (!$hasActiveRoles) {
            // Para solicitudes JSON/Ajax, devolver un error 403
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Su rol ha sido desactivado. Contacte al administrador.'
                ], 403);
            }
            
            // Para web, mostrar la página "rol desactivado"
            return response()->view('errors.role_deactivated', [], 403);
        }
        
        return $next($request);
    }
}