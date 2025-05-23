<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'idSolicitud';
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [
        'idSolicitud' => 'int',
        'idTicket' => 'int',
        'idTipoAsistencia' => 'int'
    ];

    protected $fillable = [
        'idTicket',
        'idTipoAsistencia',
        'Aplicacion',
        'ElementosAfectados'
    ];

    /**
     * Define la relación con el modelo Ticket.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'idTicket');
    }

    /**
     * Define la relación con el modelo TiposAsistencia.
     */
    public function tipoasistencia(): BelongsTo
    {
        return $this->belongsTo(Tiposasistencia::class, 'idTipoAsistencia');
    }

    /**
     * Define la relación con el modelo GestionSolicitud.
     */
    public function gestiones(): HasMany
    {
        return $this->hasMany(GestionSolicitud::class, 'idSolicitud');
    }
    
    /**
     * Registra un cambio en la gestión de la solicitud.
     */
    public function registrarCambio(string $texto): GestionSolicitud
    {
        $gestion = new GestionSolicitud();
        $gestion->idSolicitud = $this->idSolicitud;
        $gestion->Cambios = $texto;
        $gestion->created_at = now(); // Establecer fecha actual
        $gestion->updated_at = now();
        $gestion->save();
        
        return $gestion;
    }
}