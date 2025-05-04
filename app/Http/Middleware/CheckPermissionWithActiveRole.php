<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\Role;

class CheckPermissionWithActiveRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!Auth::check()) {
            // Si el usuario no está autenticado
            if ($request->expectsJson()) {
                return response()->json(['error' => 'No ha iniciado sesión.'], 401);
            }
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Verificar si el usuario tiene algún rol activo
        $hasActiveRoles = $user->roles()->where('estado', true)->exists();

        if (!$hasActiveRoles) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Su rol ha sido desactivado. Contacte al administrador.'], 403);
            }
            return redirect()->route('home');
        }
                
        // Si el usuario tiene el permiso, verificamos que provenga de un rol activo
        if ($user->hasPermissionTo($permission)) {
            // Obtenemos los roles que tienen este permiso y que el usuario posee
            $rolesWithPermission = $user->roles()
                ->whereHas('permissions', function ($query) use ($permission) {
                    $query->where('name', $permission);
                })
                ->get();
            
            // Verificamos si al menos uno de estos roles está activo
            foreach ($rolesWithPermission as $role) {
                if ($role->estado) {
                    return $next($request);
                }
            }
            
            // Si llegamos aquí, el usuario tiene el permiso pero a través de roles inactivos
            if ($request->expectsJson()) {
                return response()->json(['error' => 'No tiene permisos para realizar esta acción.'], 403);
            }
            return redirect()->route('home')->with('error', 'No tiene permisos para realizar esta acción.');
        }
        
        // Si el usuario no tiene el permiso
        if ($request->expectsJson()) {
            return response()->json(['error' => 'No tiene permisos para realizar esta acción.'], 403);
        }
        return redirect()->route('home')->with('error', 'No tiene permisos para realizar esta acción.');
    }
}