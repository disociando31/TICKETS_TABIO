<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Ticket;
use App\Models\Tiposasistencia;
use App\Http\Requests\StoreSolicitudRequest;
use App\Http\Requests\UpdateSolicitudRequest;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Solicitud::class, 'solicitud');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        
        // Verificar que el ticket sea de tipo Solicitud de servicio
        if ($ticket->Tipo !== Ticket::TIPO_SOLICITUD) {
            return redirect()->route('tickets.edit', $ticket)
                ->with('error', 'Este ticket no es de tipo Solicitud de servicio.');
        }
        
        // Obtener tipos de asistencia para el formulario
        $tiposAsistencia = Tiposasistencia::where('Estado', 'A')->get();
        
        return view('solicitudes.create', compact('ticket', 'tiposAsistencia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSolicitudRequest $request)
    {
        $ticket = Ticket::findOrFail($request->idTicket);
        $this->authorize('update', $ticket);
        
        // Crear la solicitud
        $solicitud = new Solicitud();
        $solicitud->idTicket = $ticket->idTicket;
        $solicitud->idTipoAsistencia = $request->idTipoAsistencia;
        $solicitud->Aplicacion = $request->Aplicacion;
        $solicitud->ElementosAfectados = $request->ElementosAfectados;
        $solicitud->save();
        
        // Obtener el tipo de asistencia para el registro
        $tipoAsistencia = Tiposasistencia::find($solicitud->idTipoAsistencia);
        $tipoAsistenciaText = $tipoAsistencia ? $tipoAsistencia->TipoAsistencia : 'Desconocido';
        
        // Registrar la creación en la gestión del ticket
        $user = Auth::user();
        if (($user->hasRole('Administrador') || $user->hasRole('Trabajador'))) {
            $prefijo = "[{$user->idUsuario}] {$user->nombre}: ";
            
            // Registrar creación de la solicitud
            $ticket->registrarCambio($prefijo . "Solicitud creada: {$tipoAsistenciaText}");
            
            // Registrar comentario personalizado si existe
            if ($request->filled('Cambios')) {
                $ticket->registrarCambio($prefijo . $request->Cambios);
            }
        }
        
        return redirect()->route('solicitudes.show', $solicitud)
                       ->with('success', 'Solicitud creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        // Cargar relaciones necesarias
        $solicitud->load([
            'ticket', 
            'ticket.usuario', 
            'ticket.usuario.dependencia', 
            'tipoasistencia',
            'ticket.gestiones'
        ]);
        
        return view('solicitudes.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitud $solicitud)
    {
        // Cargar el ticket y sus relaciones
        $solicitud->load(['ticket', 'tipoasistencia']);
        
        // Obtener tipos de asistencia para el formulario
        $tiposAsistencia = Tiposasistencia::where('Estado', 'A')->get();
        
        return view('solicitudes.edit', compact('solicitud', 'tiposAsistencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSolicitudRequest $request, Solicitud $solicitud)
    {
        $ticket = $solicitud->ticket;
        
        // Guardar valores originales para detectar cambios
        $oldTipoAsistenciaId = $solicitud->idTipoAsistencia;
        $oldAplicacion = $solicitud->Aplicacion;
        $oldElementosAfectados = $solicitud->ElementosAfectados;
        
        // Actualizar solicitud
        $solicitud->idTipoAsistencia = $request->idTipoAsistencia;
        $solicitud->Aplicacion = $request->Aplicacion;
        $solicitud->ElementosAfectados = $request->ElementosAfectados;
        $solicitud->save();
        
        // Registrar cambios en la gestión del ticket
        $user = Auth::user();
        if (($user->hasRole('Administrador') || $user->hasRole('Trabajador'))) {
            $prefijo = "[{$user->idUsuario}] {$user->nombre}: ";
            $cambios = [];
            
            // Registrar cambio de tipo de asistencia
            if ($oldTipoAsistenciaId != $solicitud->idTipoAsistencia) {
                $oldTipoAsistencia = Tiposasistencia::find($oldTipoAsistenciaId);
                $newTipoAsistencia = Tiposasistencia::find($solicitud->idTipoAsistencia);
                
                $oldText = $oldTipoAsistencia ? $oldTipoAsistencia->TipoAsistencia : 'Desconocido';
                $newText = $newTipoAsistencia ? $newTipoAsistencia->TipoAsistencia : 'Desconocido';
                
                $cambios[] = "Tipo de asistencia: {$oldText} -> {$newText}";
            }
            
            // Registrar cambio de aplicación si es significativo
            if ($oldAplicacion != $solicitud->Aplicacion) {
                $cambios[] = "Aplicación actualizada";
            }
            
            // Registrar cambio de elementos afectados si es significativo
            if ($oldElementosAfectados != $solicitud->ElementosAfectados) {
                $cambios[] = "Elementos afectados actualizados";
            }
            
            // Registrar cambios detectados
            if (!empty($cambios)) {
                $ticket->registrarCambio($prefijo . "Actualización de solicitud: " . implode(', ', $cambios));
            }
            
            // Registrar comentario personalizado si existe
            if ($request->filled('Cambios')) {
                $ticket->registrarCambio($prefijo . $request->Cambios);
            }
        }
        
        return redirect()->route('solicitudes.show', $solicitud)
                       ->with('success', 'Solicitud actualizada correctamente.');
    }
}