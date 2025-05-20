<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    protected $table        = 'tickets';
    protected $primaryKey   = 'idTicket';
    public    $incrementing = true;
    public    $timestamps   = false;
    
    // Constantes para estados y tipos
    const ESTADO_ABIERTO = 'Abierto';
    const ESTADO_CERRADO = 'Cerrado';
    
    const TIPO_SOPORTE = 'Soporte';
    const TIPO_SOLICITUD = 'Solicitud de servicio';
    
    const PRIORIDAD_REGULAR = 'Regular';
    const PRIORIDAD_URGENTE = 'Urgente';
    const PRIORIDAD_PRIORITARIO = 'Prioritario';

    protected $casts = [
        'idUsuario'    => 'int',
        'idGestor'     => 'int',
        'FechaCreacion'=> 'datetime',
        'FechaCierre'  => 'datetime',
    ];

    protected $fillable = [
        'Estado',
        'idUsuario',
        'Prioridad',
        'Tipo',
        'Descripcion',
        'FechaCreacion',
        'FechaCierre',
        'idGestor',
    ];

    /** El usuario que creó el ticket */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    /** El usuario asignado como gestor/técnico */
    public function gestor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idGestor');
    }

    /** Detalle de Soporte (si Tipo = 'soporte') */
    public function soporte(): HasOne
    {
        return $this->hasOne(Soporte::class, 'idTicket');
    }

    /** Detalle de Solicitud (si Tipo = 'solicitud de servicio') */
    public function solicitud(): HasOne
    {
        return $this->hasOne(Solicitud::class, 'idTicket');
    }
    
    /** Historial de gestión del ticket */
    public function gestiones(): HasMany
    {
        return $this->hasMany(GestionTicket::class, 'idTicket');
    }
    
    /**
     * Registra un cambio en la gestión del ticket.
     */
    public function registrarCambio(string $texto): GestionTicket
    {
        $gestion = new GestionTicket();
        $gestion->idTicket = $this->idTicket;
        $gestion->Cambios = $texto;
        $gestion->save();
        
        return $gestion;
    }
    
    /**
     * Scope para filtrar tickets según parámetros de request
     */
    public function scopeFiltered($query, Request $request)
    {
        return $query
            ->when($request->tipo, fn($q) => $q->where('Tipo', $request->tipo))
            ->when($request->estado, fn($q) => $q->where('Estado', $request->estado))
            ->when($request->prioridad, fn($q) => $q->where('Prioridad', $request->prioridad))
            
            // Filtro por rango de fechas
            ->when($request->fecha_desde, function($q) use ($request) {
                return $q->whereDate('FechaCreacion', '>=', $request->fecha_desde);
            })
            ->when($request->fecha_hasta, function($q) use ($request) {
                return $q->whereDate('FechaCreacion', '<=', $request->fecha_hasta);
            })
            
            // Filtro por nombre de usuario creador
            ->when($request->creador_nombre, function($q) use ($request) {
                return $q->whereHas('usuario', function($query) use ($request) {
                    $query->where('nombre', 'like', '%' . $request->creador_nombre . '%');
                });
            })
            
            // Filtro por usuario asignado
            ->when($request->asignado, function($q) use ($request) {
                if ($request->asignado == 'sin_asignar') {
                    return $q->whereNull('idGestor');
                }
                return $q->where('idGestor', $request->asignado);
            });
    }
}