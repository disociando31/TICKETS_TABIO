<?php

namespace App\Http\Controllers;

use App\Models\TipoEquipo; // Asegúrate de importar tu modelo si lo tienes
use Illuminate\Http\Request;

class TiposEquipoController extends Controller
{
    /**
     * Muestra una lista de los tipos de equipo.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lógica para obtener y mostrar todos los tipos de equipo
        $tiposEquipos = TipoEquipo::all(); // Ejemplo usando un modelo
        return view('tipos-equipos.index', compact('tiposEquipos'));
    }

    /**
     * Muestra el formulario para crear un nuevo tipo de equipo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tipos-equipos.create');
    }

    /**
     * Guarda un nuevo tipo de equipo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Lógica para validar y guardar el nuevo tipo de equipo
        // Ejemplo:
        // TipoEquipo::create($request->all());
        return redirect()->route('tipos-equipos.index')->with('success', 'Tipo de equipo creado exitosamente.');
    }

    /**
     * Muestra los detalles de un tipo de equipo específico.
     *
     * @param  \App\Models\TipoEquipo  $tipoEquipo
     * @return \Illuminate\View\View
     */
    public function show(TipoEquipo $tipoEquipo)
    {
        return view('tipos-equipos.show', compact('tipoEquipo'));
    }

    /**
     * Muestra el formulario para editar un tipo de equipo existente.
     *
     * @param  \App\Models\TipoEquipo  $tipoEquipo
     * @return \Illuminate\View\View
     */
    public function edit(TipoEquipo $tipoEquipo)
    {
        return view('tipos-equipos.edit', compact('tipoEquipo'));
    }

    /**
     * Actualiza un tipo de equipo específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TipoEquipo $tipoEquipo)
    {
        // Lógica para validar y actualizar el tipo de equipo
        // Ejemplo:
        // $tipoEquipo->update($request->all());
        return redirect()->route('tipos-equipos.index')->with('success', 'Tipo de equipo actualizado exitosamente.');
    }

    /**
     * Elimina un tipo de equipo específico de la base de datos.
     *
     * @param  \App\Models\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TipoEquipo $tipoEquipo)
    {
        // Lógica para eliminar el tipo de equipo
        // Ejemplo:
        // $tipoEquipo->delete();
        return redirect()->route('tipos-equipos.index')->with('success', 'Tipo de equipo eliminado exitosamente.');
    }
}