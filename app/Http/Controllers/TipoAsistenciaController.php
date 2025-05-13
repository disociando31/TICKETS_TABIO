<?php

namespace App\Http\Controllers;

use App\Models\TipoAsistencia; // Asegúrate de importar tu modelo si lo tienes
use Illuminate\Http\Request;

class TipoAsistenciaController extends Controller
{
    /**
     * Muestra una lista de los tipos de asistencia.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lógica para obtener y mostrar todos los tipos de asistencia
        $tiposAsistencia = TipoAsistencia::all(); // Ejemplo usando un modelo
        return view('tipos-asistencia.index', compact('tiposAsistencia'));
    }

    /**
     * Muestra el formulario para crear un nuevo tipo de asistencia.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tipos-asistencia.create');
    }

    /**
     * Guarda un nuevo tipo de asistencia en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Lógica para validar y guardar el nuevo tipo de asistencia
        // Ejemplo:
        // TipoAsistencia::create($request->all());
        return redirect()->route('tipos-asistencia.index')->with('success', 'Tipo de asistencia creado exitosamente.');
    }

    /**
     * Muestra los detalles de un tipo de asistencia específico.
     *
     * @param  \App\Models\TipoAsistencia  $tipoAsistencia
     * @return \Illuminate\View\View
     */
    public function show(TipoAsistencia $tipoAsistencia)
    {
        return view('tipos-asistencia.show', compact('tipoAsistencia'));
    }

    /**
     * Muestra el formulario para editar un tipo de asistencia existente.
     *
     * @param  \App\Models\TipoAsistencia  $tipoAsistencia
     * @return \Illuminate\View\View
     */
    public function edit(TipoAsistencia $tipoAsistencia)
    {
        return view('tipos-asistencia.edit', compact('tipoAsistencia'));
    }

    /**
     * Actualiza un tipo de asistencia específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoAsistencia  $tipoAsistencia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TipoAsistencia $tipoAsistencia)
    {
        // Lógica para validar y actualizar el tipo de asistencia
        // Ejemplo:
        // $tipoAsistencia->update($request->all());
        return redirect()->route('tipos-asistencia.index')->with('success', 'Tipo de asistencia actualizado exitosamente.');
    }

    /**
     * Elimina un tipo de asistencia específico de la base de datos.
     *
     * @param  \App\Models\TipoAsistencia  $tipoAsistencia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TipoAsistencia $tipoAsistencia)
    {
        // Lógica para eliminar el tipo de asistencia
        // Ejemplo:
        // $tipoAsistencia->delete();
        return redirect()->route('tipos-asistencia.index')->with('success', 'Tipo de asistencia eliminado exitosamente.');
    }
}