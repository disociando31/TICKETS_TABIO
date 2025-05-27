<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Soporte extends Model
{
    protected $table = 'soportes';
    protected $primaryKey = 'idSoporte';
    public $incrementing = true;
    public $timestamps = false;

    // Constantes para tipos
    const TIPO_EQUIPO_IMPRESORA = 'Impresora';
    const TIPO_EQUIPO_SCANNER = 'Scanner';
    const TIPO_EQUIPO_MONITOR = 'Monitor';
    const TIPO_EQUIPO_CPU = 'CPU';
    const TIPO_EQUIPO_OTRO = 'Otro';
    
    const TIPO_SOPORTE_SOLICITUD = 'Solicitud';
    const TIPO_SOPORTE_DIAGNOSTICO = 'Diagnostico';
    const TIPO_SOPORTE_BAJA = 'Baja';
    const TIPO_SOPORTE_OTRO = 'Otro';
    
    const TIPO_MANTENIMIENTO_PREVENTIVO = 'Preventivo';
    const TIPO_MANTENIMIENTO_CORRECTIVO = 'Correctivo';

    protected $fillable = [
        'idTicket',
        'TipoEquipo',
        'TipoSoporte',
        'TipoMantenimiento',
        'idEquipo',
    ];

    protected $casts = [
        'idSoporte' => 'int',
        'idTicket' => 'int',
        'TipoEquipo' => 'string',
        'TipoSoporte' => 'string',
        'TipoMantenimiento' => 'string',
        'idEquipo' => 'int',
    ];

    /**
     * Define la relación con el modelo Ticket.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'idTicket');
    }
    
    /**
     * Define la relación con el modelo GestionSoporte.
     */
    public function gestiones(): HasMany
    {
        return $this->hasMany(GestionSoporte::class, 'idSoporte');
    }
      
    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'idEquipo');
    }
    
    /**
     * Registra un cambio en la gestión del soporte.
     */
    public function registrarCambio(string $texto): GestionSoporte
    {
        $gestion = new GestionSoporte();
        $gestion->idSoporte = $this->idSoporte;
        $gestion->Cambios = $texto;
        $gestion->created_at = now(); // Establecer fecha actual
        $gestion->updated_at = now();
        $gestion->save();
        
        return $gestion;
    }
}