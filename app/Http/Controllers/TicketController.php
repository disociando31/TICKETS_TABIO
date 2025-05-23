<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ticket::filtered($request);
        
        // Restricción según rol:
        $user = Auth::user();
        
        if ($user->hasRole('Usuario')) {
            // Usuario normal solo ve sus propios tickets
            $query->where('idUsuario', $user->idUsuario);
        } elseif ($user->hasRole('Trabajador') && !$request->filled('creador_nombre')) {
            // Trabajador ve los que creó y los que tiene asignados
            // (a menos que se esté filtrando por nombre de creador)
            $query->where(function($q) use ($user) {
                $q->where('idUsuario', $user->idUsuario)
                ->orWhere('idGestor', $user->idUsuario);
            });
        }
        // El admin ve todos (no se aplica filtro adicional)
        
        $tickets = $query->with(['usuario', 'gestor'])
                        ->latest('idTicket')
                        ->paginate(10);
        
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        // Buscar el primer administrador para asignar por defecto
        $adminUser = User::role('Administrador')->first();
        
        $ticket = new Ticket();
        $ticket->fill($request->validated());
        $ticket->Estado = Ticket::ESTADO_ABIERTO;
        $ticket->Prioridad = Ticket::PRIORIDAD_REGULAR;
        $ticket->idUsuario = Auth::id();
        $ticket->idGestor = $adminUser ? $adminUser->idUsuario : null;
        $ticket->FechaCreacion = now();
        $ticket->save();
        
        // Registrar la creación del ticket
        $usuario = Auth::user();
        $prefijo = "[{$usuario->idUsuario}] {$usuario->nombre}: ";
        $ticket->registrarCambio($prefijo . "Ticket creado con tipo {$ticket->Tipo}");
        
        // Redireccionar según el tipo de ticket
        return $this->redirectToTypeForm($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['usuario', 'gestor', 'gestiones']);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $ticket->load(['usuario', 'gestor']);
        return view('tickets.edit', compact('ticket'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // Guardar valores originales para detectar cambios
        $oldTipo = $ticket->Tipo;
        $oldPrioridad = $ticket->Prioridad;
        $oldEstado = $ticket->Estado;
        $oldGestorId = $ticket->idGestor;
        
        // Determinar la acción que se va a realizar
        $action = $request->input('action', 'save');
        
        // Si es usuario regular, solo actualiza tipo y prioridad
        if (Auth::user()->hasRole('Usuario')) {
            $ticket->Tipo = $request->Tipo;
            $ticket->Prioridad = $request->Prioridad;
        } else {
            // Admin o Trabajador actualiza todo
            $ticket->fill($request->validated());
            
            // Solo los administradores pueden cambiar el gestor
            if (!Auth::user()->hasRole('Administrador')) {
                $ticket->idGestor = $oldGestorId;
            }
            
            // Si se cierra el ticket, registrar fecha de cierre
            if ($request->Estado == Ticket::ESTADO_CERRADO && $oldEstado != Ticket::ESTADO_CERRADO) {
                $ticket->FechaCierre = now();
            }
        }
        
        $ticket->save();
        
        // Registrar cambios en la gestión
        $user = Auth::user();
        $prefijo = "[{$user->idUsuario}] {$user->nombre}: ";
        
        // Registrar cambio de tipo
        if ($oldTipo != $ticket->Tipo) {
            $ticket->registrarCambio($prefijo . "Cambio de tipo: {$oldTipo} -> {$ticket->Tipo}");
        }
        
        // Registrar cambio de prioridad
        if ($oldPrioridad != $ticket->Prioridad) {
            $ticket->registrarCambio($prefijo . "Cambio de prioridad: {$oldPrioridad} -> {$ticket->Prioridad}");
        }
        
        // Registrar cambio de estado
        if ($oldEstado != $ticket->Estado) {
            $ticket->registrarCambio($prefijo . "Cambio de estado: {$oldEstado} -> {$ticket->Estado}");
        }
        
        // Registrar reasignación - solo si es administrador
        if ($oldGestorId != $ticket->idGestor && Auth::user()->hasRole('Administrador')) {
            $nuevoGestor = User::find($ticket->idGestor);
            $oldGestor = $oldGestorId ? User::find($oldGestorId) : null;
            
            $oldGestorText = $oldGestor ? "[{$oldGestor->idUsuario}] {$oldGestor->nombre}" : "Sin asignar";
            $nuevoGestorText = $nuevoGestor ? "[{$nuevoGestor->idUsuario}] {$nuevoGestor->nombre}" : "Sin asignar";
            
            $ticket->registrarCambio($prefijo . "Reasignación: {$oldGestorText} -> {$nuevoGestorText}");
        }
        
        // Registrar comentario personalizado si existe
        if ($request->filled('Cambios')) {
            $ticket->registrarCambio($prefijo . $request->Cambios);
        }
        
        // Si cambió el tipo, redirigir para crear nuevo detalle independientemente de la acción
        if ($oldTipo != $ticket->Tipo) {
            return $this->redirectToTypeForm($ticket);
        }
        
        // Redireccionar según la acción elegida
        if ($action === 'continue_soporte' && $ticket->Tipo === Ticket::TIPO_SOPORTE) {
            if ($ticket->soporte) {
                // Redirigir a editar soporte existente
                return redirect()->route('soportes.edit', $ticket->soporte)
                    ->with('success', 'Ticket actualizado correctamente.');
            } else {
                // Redirigir a crear nuevo soporte
                return redirect()->route('soportes.create', $ticket)
                    ->with('success', 'Ticket actualizado correctamente. Complete los detalles del soporte.');
            }
        } else if ($action === 'continue_solicitud' && $ticket->Tipo === Ticket::TIPO_SOLICITUD) {
            if ($ticket->solicitud) {
                // Redirigir a editar solicitud existente
                return redirect()->route('solicitudes.edit', $ticket->solicitud)
                    ->with('success', 'Ticket actualizado correctamente.');
            } else {
                // Redirigir a crear nueva solicitud
                return redirect()->route('solicitudes.create', $ticket)
                    ->with('success', 'Ticket actualizado correctamente. Complete los detalles de la solicitud.');
            }
        }
        
        // Por defecto, redirigir al listado
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return back()->with('success', 'Ticket eliminado correctamente.');
    }
    
    /**
     * Redirecciona al formulario apropiado según el tipo de ticket
     */
    private function redirectToTypeForm(Ticket $ticket)
    {
        if ($ticket->Tipo == Ticket::TIPO_SOPORTE) {
            return redirect()->route('soportes.create', $ticket)
                           ->with('success', 'Ticket creado. Complete los detalles del soporte.');
        } else {
            return redirect()->route('solicitudes.create', $ticket)
                           ->with('success', 'Ticket creado. Complete los detalles de la solicitud.');
        }
    }
}