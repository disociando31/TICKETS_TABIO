<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Constructor del controlador
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission.active:gestionar_roles');
    }

    /**
     * Muestra un listado de los roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     * DESHABILITADO - No se pueden crear nuevos roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('roles.index')
            ->with('error', 'La creación de nuevos roles está deshabilitada.');
    }

    /**
     * Almacena un rol recién creado.
     * DESHABILITADO - No se pueden crear nuevos roles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('roles.index')
            ->with('error', 'La creación de nuevos roles está deshabilitada.');
    }

    /**
     * Muestra la información de un rol específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Role::findOrFail($id);
        $permisos = $rol->permissions;
        
        return view('roles.show', compact('rol', 'permisos'));
    }

    /**
     * Muestra el formulario para editar un rol.
     * DESHABILITADO - No se pueden editar roles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('roles.index')
            ->with('error', 'La edición de roles está deshabilitada. Solo puede activar/desactivar roles.');
    }

    /**
     * Actualiza el rol específico.
     * DESHABILITADO - No se pueden editar roles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('roles.index')
            ->with('error', 'La edición de roles está deshabilitada. Solo puede activar/desactivar roles.');
    }

    /**
     * Cambia el estado del rol (activar/desactivar).
     * ÚNICA FUNCIONALIDAD PERMITIDA
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleEstado($id)
    {
        $rol = Role::findOrFail($id);
        
        // Evitar desactivar roles críticos del sistema
        if (in_array($rol->name, ['Administrador']) && $rol->estado) {
            return redirect()->route('roles.index')
                ->with('error', 'No se puede desactivar el rol de Administrador');
        }
        
        // Cambiar el estado
        $rol->estado = !$rol->estado;
        $rol->save();
        
        // Limpiar la caché de permisos para que los cambios tengan efecto inmediato
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $mensaje = $rol->estado ? 'activado' : 'desactivado';
        return redirect()->route('roles.index')
            ->with('success', "Rol {$mensaje} correctamente.");
    }

    /**
     * No permitimos eliminar roles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('roles.index')
            ->with('error', 'Los roles no pueden ser eliminados, solo desactivados.');
    }
}