<?php

namespace App\Http\Controllers;

use App\Models\GestionSoporte; // Asegúrate de importar tu modelo si lo tienes
use Illuminate\Http\Request;

class GestionSoporteController extends Controller
{
    /**
     * Muestra una lista de los registros de soporte.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lógica para obtener y mostrar todos los registros de soporte
        $registrosSoporte = GestionSoporte::all(); // Ejemplo usando un modelo
        return view('gestion-soporte.index', compact('registrosSoporte'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro de soporte.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('gestion-soporte.create');
    }

    /**
     * Guarda un nuevo registro de soporte en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Lógica para validar y guardar el nuevo registro de soporte
        // Ejemplo:
        // GestionSoporte::create($request->all());
        return redirect()->route('gestion-soporte.index')->with('success', 'Registro de soporte creado exitosamente.');
    }

    /**
     * Muestra los detalles de un registro de soporte específico.
     *
     * @param  \App\Models\GestionSoporte  $gestionSoporte
     * @return \Illuminate\View\View
     */
    public function show(GestionSoporte $gestionSoporte)
    {
        return view('gestion-soporte.show', compact('gestionSoporte'));
    }

    /**
     * Muestra el formulario para editar un registro de soporte existente.
     *
     * @param  \App\Models\GestionSoporte  $gestionSoporte
     * @return \Illuminate\View\View
     */
    public function edit(GestionSoporte $gestionSoporte)
    {
        return view('gestion-soporte.edit', compact('gestionSoporte'));
    }

    /**
     * Actualiza un registro de soporte específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GestionSoporte  $gestionSoporte
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, GestionSoporte $gestionSoporte)
    {
        // Lógica para validar y actualizar el registro de soporte
        // Ejemplo:
        // $gestionSoporte->update($request->all());
        return redirect()->route('gestion-soporte.index')->with('success', 'Registro de soporte actualizado exitosamente.');
    }

    /**
     * Elimina un registro de soporte específico de la base de datos.
     *
     * @param  \App\Models\GestionSoporte  $gestionSoporte
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GestionSoporte $gestionSoporte)
    {
        // Lógica para eliminar el registro de soporte
        // Ejemplo:
        // $gestionSoporte->delete();
        return redirect()->route('gestion-soporte.index')->with('success', 'Registro de soporte eliminado exitosamente.');
    }
}