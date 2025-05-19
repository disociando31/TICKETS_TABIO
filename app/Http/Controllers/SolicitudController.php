<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

// If the model file does not exist, create it with:
// php artisan make:model Solicitud

class SolicitudController extends Controller
{
    /**
     * Display a listing of the solicitudes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitud::with(['ticket', 'tipoAsistencia'])->get(); // Eager load relationships
        return view('solicitudes.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new solicitud.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tickets = \App\Models\Ticket::all(); // Get all tickets for the dropdown
        $tiposAsistencia = \App\Models\TipoAsistencia::all(); // Get all tiposAsistencia
        return view('solicitudes.create', compact('tickets', 'tiposAsistencia'));
    }

    /**
     * Store a newly created solicitud in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'idTicket' => 'required|exists:tickets,idTicket',
            'idTipoAsistencia' => 'required|exists:tiposasistencia,idTipoAsistencia',
            'Aplicacion' => 'required',
            'ElementosAfectados' => 'required',
        ]);

        Solicitud::create($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada exitosamente.');
    }

    /**
     * Display the specified solicitud.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        $solicitud->load(['ticket', 'tipoAsistencia']); // Load relationships
        return view('solicitudes.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified solicitud.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        $tickets = \App\Models\Ticket::all();
        $tiposAsistencia = \App\Models\Tipoasistencia::all();
        return view('solicitudes.edit', compact('solicitud', 'tickets', 'tiposAsistencia'));
    }

    /**
     * Update the specified solicitud in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'idTicket' => 'required|exists:tickets,idTicket',
            'idTipoAsistencia' => 'required|exists:tiposasistencia,idTipoAsistencia',
            'Aplicacion' => 'required',
            'ElementosAfectados' => 'required',
        ]);

        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    /**
     * Remove the specified solicitud from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada exitosamente.');
    }
}