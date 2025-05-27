<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use App\Models\Ticket;
use App\Models\Equipo;
use App\Http\Requests\StoreSoporteRequest;
use App\Http\Requests\UpdateSoporteRequest;
use Illuminate\Support\Facades\Auth;

class SoporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Soporte::class, 'soporte');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        
        // Verificar que el ticket sea de tipo Soporte
        if ($ticket->Tipo !== Ticket::TIPO_SOPORTE) {
            return redirect()->route('tickets.edit', $ticket)
                ->with('error', 'Este ticket no es de tipo Soporte.');
        }
        
        // Consultar equipos disponibles
        $equipos = Equipo::all();
        
        return view('soportes.create', compact('ticket', 'equipos'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSoporteRequest $request)
    {
        $ticket = Ticket::findOrFail($request->idTicket);
        $this->authorize('update', $ticket);
        
        // Crear el soporte
        $soporte = new Soporte();
        $soporte->idTicket = $ticket->idTicket;
        $soporte->TipoEquipo = $request->TipoEquipo;
        $soporte->TipoSoporte = $request->TipoSoporte;
        $soporte->TipoMantenimiento = $request->TipoMantenimiento;
        $soporte->save();
        
        // Registrar la creación en la gestión del ticket
        $user = Auth::user();
        if (($user->hasRole('Administrador') || $user->hasRole('Trabajador'))) {
            $prefijo = "[{$user->idUsuario}] {$user->nombre}: ";
            
            // Registrar creación del soporte
            $ticket->registrarCambio($prefijo . "Soporte creado: {$soporte->TipoSoporte} / {$soporte->TipoMantenimiento}");
            
            // Registrar comentario personalizado si existe
            if ($request->filled('Cambios')) {
                $ticket->registrarCambio($prefijo . $request->Cambios);
            }
        }
        
        return redirect()->route('soportes.show', $soporte)
                       ->with('success', 'Soporte creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Soporte $soporte)
    {
        // Cargar relaciones necesarias
        $soporte->load([
            'ticket', 
            'ticket.usuario', 
            'ticket.usuario.dependencia',
            'ticket.gestiones'
        ]);
        
        return view('soportes.show', compact('soporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soporte $soporte)
    {
        // Cargar el ticket y sus relaciones
        $soporte->load('ticket');
        
        return view('soportes.edit', compact('soporte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSoporteRequest $request, Soporte $soporte)
    {
        $ticket = $soporte->ticket;
        
        // Guardar valores originales para detectar cambios
        $oldTipoEquipo = $soporte->TipoEquipo;
        $oldTipoSoporte = $soporte->TipoSoporte;
        $oldTipoMantenimiento = $soporte->TipoMantenimiento;
        
        // Actualizar soporte
        $soporte->TipoEquipo = $request->TipoEquipo;
        $soporte->TipoSoporte = $request->TipoSoporte;
        $soporte->TipoMantenimiento = $request->TipoMantenimiento;
        $soporte->save();
        
        // Registrar cambios en la gestión del ticket
        $user = Auth::user();
        if (($user->hasRole('Administrador') || $user->hasRole('Trabajador'))) {
            $prefijo = "[{$user->idUsuario}] {$user->nombre}: ";
            $cambios = [];
            
            // Registrar cambios en los tipos
            if ($oldTipoEquipo != $soporte->TipoEquipo) {
                $cambios[] = "Equipo: {$oldTipoEquipo} -> {$soporte->TipoEquipo}";
            }
            
            if ($oldTipoSoporte != $soporte->TipoSoporte) {
                $cambios[] = "Soporte: {$oldTipoSoporte} -> {$soporte->TipoSoporte}";
            }
            
            if ($oldTipoMantenimiento != $soporte->TipoMantenimiento) {
                $cambios[] = "Mantenimiento: {$oldTipoMantenimiento} -> {$soporte->TipoMantenimiento}";
            }
            
            // Registrar cambios detectados
            if (!empty($cambios)) {
                $ticket->registrarCambio($prefijo . "Actualización de soporte: " . implode(', ', $cambios));
            }
            
            // Registrar comentario personalizado si existe
            if ($request->filled('Cambios')) {
                $ticket->registrarCambio($prefijo . $request->Cambios);
            }
        }
        
        return redirect()->route('soportes.show', $soporte)
                       ->with('success', 'Soporte actualizado correctamente.');
    }
}