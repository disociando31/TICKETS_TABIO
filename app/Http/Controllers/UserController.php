<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dependencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Constructor del controlador
     */
    public function __construct()
    {
        // Todos deben estar autenticados
        $this->middleware('auth');
        
        // Solo administradores pueden ver el listado y crear/editar/eliminar usuarios
        $this->middleware('role:Administrador')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        
        // Para ver su propio perfil
        $this->middleware('permission:gestionar_perfil')->only(['show']);
    }

    /**
     * Muestra un listado de los usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Solo administradores pueden llegar aquí debido al middleware
        $usuarios = User::with('dependencia')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dependencias = Dependencia::all();
        $roles = Role::all();
        
        return view('usuarios.create', compact('dependencias', 'roles'));
    }

    /**
     * Almacena un usuario recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'idDependencia' => 'required|exists:dependencias,idDependencia',
            'rol' => 'required|exists:roles,name'
        ]);

        // Crear usuario
        $usuario = User::create([
            'nombre' => $request->nombre,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'idDependencia' => $request->idDependencia,
        ]);

        // Asignar rol usando Spatie
        $usuario->assignRole($request->rol);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra la información de un usuario específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Si es el propio usuario o un administrador puede ver el detalle
        if (Auth::id() == $id || Auth::user()->hasRole('Administrador')) {
            $usuario = User::with('dependencia')->findOrFail($id);
            return view('usuarios.show', compact('usuario'));
        }
        
        abort(403, 'No tiene permiso para ver este usuario.');
    }

    /**
     * Muestra el formulario para editar un usuario específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $dependencias = Dependencia::all();
        $roles = Role::all();
        $userRoles = $usuario->getRoleNames()->toArray();; // Método de Spatie para obtener nombres de roles
        
        return view('usuarios.edit', compact('usuario', 'dependencias', 'roles', 'userRoles'));
    }

    /**
     * Actualiza el usuario específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($id, 'idUsuario')
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'idDependencia' => 'required|exists:dependencias,idDependencia',
            'rol' => 'required|exists:roles,name'
        ]);

        // Actualizar usuario
        $usuario->nombre = $request->nombre;
        $usuario->username = $request->username;
        $usuario->telefono = $request->telefono;
        $usuario->idDependencia = $request->idDependencia;
        
        // Actualizar contraseña solo si se proporciona
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        
        $usuario->save();

        // Sincronizar roles (quitar todos los roles anteriores y asignar el nuevo)
        $usuario->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina el usuario específico de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Evitar que se elimine a sí mismo
        if (Auth::id() == $id) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puede eliminar su propio usuario.');
        }

        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
    
    /**
     * Permite al usuario editar su propio perfil
     */
    public function editarPerfil()
    {
        $usuario = Auth::user();
        return view('usuarios.perfil', compact('usuario'));
    }
    
    /**
     * Actualiza el perfil del usuario actual
     */
    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();
        
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'password_actual' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed'
        ]);
        
        // Verificar contraseña actual si se quiere cambiar
        if ($request->filled('password_actual') && !Hash::check($request->password_actual, $usuario->password)) {
            return back()->withErrors(['password_actual' => 'La contraseña actual no es correcta.']);
        }
        
        // Actualizar datos
        $usuario->nombre = $request->nombre;
        $usuario->telefono = $request->telefono;
        
        // Actualizar contraseña si se proporciona
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        
        $usuario->save();
        
        return redirect()->route('perfil')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}