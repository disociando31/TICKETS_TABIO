<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GestionTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->hasRole('Administrador') && !Auth::user()->hasRole('Trabajador')) {
                return response()->json(['error' => 'No autorizado'], 403);
            }
            return $next($request);
        });
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'idTicket' => 'required|exists:tickets,idTicket',
            'Cambios' => 'required|string',
        ]);
        
        $ticket = Ticket::findOrFail($validated['idTicket']);
        
        // Verificar que el usuario pueda modificar este ticket
        if (!Auth::user()->can('update', $ticket)) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        
        $usuario = Auth::user();
        $prefijo = "[{$usuario->idUsuario}] {$usuario->nombre}: ";
        
        $gestion = $ticket->registrarCambio($prefijo . $validated['Cambios']);
        
        return response()->json(['success' => true, 'gestion' => $gestion]);
    }
}