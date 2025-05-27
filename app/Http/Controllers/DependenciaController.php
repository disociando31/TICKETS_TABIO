<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DependenciaController extends Controller
{
    public function __construct()
    {
        // Solo administradores pueden gestionar dependencias
        $this->middleware('role.active:Administrador');
        $this->middleware('auth');
    }

    /**
     * Muestra un listado de las dependencias.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependencias = Dependencia::all();
        return view('Dependencias.index', compact('dependencias'));
    }

    /**
     * Muestra el formulario para crear una nueva dependencia.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dependencias.create');
    }

    /**
     * Almacena una dependencia recién creada.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Dependencia' => 'required|string|max:255|unique:dependencias,Dependencia',
        ]);

        // Por default, el estado es Activo
        Dependencia::create([
            'Dependencia' => $request->Dependencia,
            'Estado' => 'A'
        ]);

        return redirect()->route('dependencias.index')
            ->with('success', 'Dependencia creada correctamente.');
    }

    /**
     * Muestra la información de una dependencia específica.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependencia = Dependencia::findOrFail($id);
        return view('Dependencias.show', compact('dependencia'));
    }

    /**
     * Muestra el formulario para editar una dependencia.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dependencia = Dependencia::findOrFail($id);
        return view('Dependencias.edit', compact('dependencia'));
    }

    /**
     * Actualiza la dependencia específica.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dependencia = Dependencia::findOrFail($id);
        
        $request->validate([
            'Dependencia' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dependencias', 'Dependencia')->ignore($id, 'idDependencia')
            ],
            'Estado' => 'required|in:A,I'
        ]);

        $dependencia->update([
            'Dependencia' => $request->Dependencia,
            'Estado' => $request->Estado
        ]);

        return redirect()->route('Dependencias.index')
            ->with('success', 'Dependencia actualizada correctamente.');
    }

    /**
     * Cambia el estado de la dependencia (activo/inactivo).
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function toggleEstado($id)
    {
        $dependencia = Dependencia::findOrFail($id);
        
        // Cambia el estado: si es A pasa a I, si es I pasa a A
        $nuevoEstado = ($dependencia->Estado == 'A') ? 'I' : 'A';
        
        $dependencia->update([
            'Estado' => $nuevoEstado
        ]);
        
        $mensaje = ($nuevoEstado == 'A') ? 'activada' : 'desactivada';
        
        return redirect()->route('dependencias.index')
            ->with('success', "Dependencia {$mensaje} correctamente.");
    }

    /**
     * Elimina la dependencia específica.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dependencia = Dependencia::findOrFail($id);
        
        // Verificar si hay usuarios asociados
        if ($dependencia->usuarios()->count() > 0) {
            return back()->withErrors(['error' => 'No se puede eliminar esta dependencia porque hay usuarios asociados.']);
        }
        
        // Verificar si hay equipos asociados
        if ($dependencia->equipos()->count() > 0) {
            return back()->withErrors(['error' => 'No se puede eliminar esta dependencia porque hay equipos asociados.']);
        }
        
        $dependencia->delete();

        return redirect()->route('Dependencias.index')
            ->with('success', 'Dependencia eliminada correctamente.');
    }
}