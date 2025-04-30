<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\Role;

class CheckRoleStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (empty($roles)) {
            return $next($request);
        }

        $user = Auth::user();
        
        // Verificar que el usuario tenga alguno de los roles especificados
        // y que el rol esté activo (estado=true)
        foreach ($roles as $role) {
            // Obtener el rol directamente de la BD para verificar su estado
            $roleModel = Role::where('name', $role)->first();
            
            if ($roleModel && $roleModel->estado && $user->hasRole($role)) {
                return $next($request);
            }
        }
        
        throw UnauthorizedException::forRoles($roles);
    }
}