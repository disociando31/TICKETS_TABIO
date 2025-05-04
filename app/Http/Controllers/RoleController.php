<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('roles.create', compact('permisos'));
    }

        /**
     * Almacena un rol recién creado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permisos' => 'required|array',
            'permisos.*' => 'exists:permissions,id'
        ]);

        DB::beginTransaction();
        try {
            // Crear el rol con el estado activo
            $rol = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
                'estado' => true
            ]);

            // Obtener los nombres de permisos a partir de los IDs
            $permissionNames = Permission::whereIn('id', $request->permisos)->pluck('name')->toArray();
            
            // Asignar permisos
            $rol->syncPermissions($permissionNames);
            
            DB::commit();
            return redirect()->route('roles.index')
                ->with('success', 'Rol creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear el rol: ' . $e->getMessage()]);
        }
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        $permisos = Permission::all();
        $rolPermisos = $rol->permissions->pluck('id')->toArray();
        
        return view('roles.edit', compact('rol', 'permisos', 'rolPermisos'));
    }

    /**
     * Actualiza el rol específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rol = Role::findOrFail($id);
        
        $request->validate([
            'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('roles', 'name')->ignore($id)
            ],
            'permisos' => 'required|array',
            'permisos.*' => 'exists:permissions,id'
        ]);

        DB::beginTransaction();
        try {
            // Actualizar el rol
            $rol->name = $request->name;
            $rol->save();

            // Sincronizar permisos
            $rol->syncPermissions($request->permisos);
            
            DB::commit();
            return redirect()->route('roles.index')
                ->with('success', 'Rol actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar el rol: ' . $e->getMessage()]);
        }
    }

    /**
     * Cambia el estado del rol (activar/desactivar).
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
     * No permitimos eliminar roles, solo desactivarlos.
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