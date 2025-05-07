<?php

namespace App\Http\Controllers;

use App\Models\TipoMantenimiento; // Asegúrate de importar tu modelo si lo tienes
use Illuminate\Http\Request;

class TiposMantenimientoController extends Controller
{
    /**
     * Muestra una lista de los tipos de mantenimiento.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Aquí puedes obtener todos los tipos de mantenimiento de la base de datos
        $tiposMantenimiento = TipoMantenimiento::all(); // Ejemplo usando un modelo
        return view('tipos-mantenimiento.index', compact('tiposMantenimiento'));
    }

    /**
     * Muestra el formulario para crear un nuevo tipo de mantenimiento.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tipos-mantenimiento.create');
    }

    /**
     * Guarda un nuevo tipo de mantenimiento en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Aquí puedes validar los datos del formulario y guardar el nuevo tipo de mantenimiento
        // Ejemplo:
        // TipoMantenimiento::create($request->all());
        return redirect()->route('tipos-mantenimiento.index')->with('success', 'Tipo de mantenimiento creado exitosamente.');
    }

    /**
     * Muestra los detalles de un tipo de mantenimiento específico.
     *
     * @param  \App\Models\TipoMantenimiento  $tipoMantenimiento
     * @return \Illuminate\View\View
     */
    public function show(TipoMantenimiento $tipoMantenimiento)
    {
        return view('tipos-mantenimiento.show', compact('tipoMantenimiento'));
    }

    /**
     * Muestra el formulario para editar un tipo de mantenimiento existente.
     *
     * @param  \App\Models\TipoMantenimiento  $tipoMantenimiento
     * @return \Illuminate\View\View
     */
    public function edit(TipoMantenimiento $tipoMantenimiento)
    {
        return view('tipos-mantenimiento.edit', compact('tipoMantenimiento'));
    }

    /**
     * Actualiza un tipo de mantenimiento específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoMantenimiento  $tipoMantenimiento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TipoMantenimiento $tipoMantenimiento)
    {
        // Aquí puedes validar los datos del formulario y actualizar el tipo de mantenimiento
        // Ejemplo:
        // $tipoMantenimiento->update($request->all());
        return redirect()->route('tipos-mantenimiento.index')->with('success', 'Tipo de mantenimiento actualizado exitosamente.');
    }

    /**
     * Elimina un tipo de mantenimiento específico de la base de datos.
     *
     * @param  \App\Models\TipoMantenimiento  $tipoMantenimiento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TipoMantenimiento $tipoMantenimiento)
    {
        // Aquí puedes eliminar el tipo de mantenimiento
        // Ejemplo:
        // $tipoMantenimiento->delete();
        return redirect()->route('tipos-mantenimiento.index')->with('success', 'Tipo de mantenimiento eliminado exitosamente.');
    }
}