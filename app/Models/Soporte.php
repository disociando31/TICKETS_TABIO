<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soporte extends Model
{
    protected $table = 'soportes';
    protected $primaryKey = 'idSoporte';
    public $incrementing = false;
    public $timestamps = false; // Asumo que no tienes campos created_at y updated_at

    protected $fillable = [
        'idTicket',
        'TipoEquipo',
        'TipoSoporte',
        'TipoMantenimiento',
    ];

    protected $casts = [
        'idSoporte' => 'int',
        'idTicket' => 'int',
        'TipoEquipo' => 'string',
        'TipoSoporte' => 'string',
        'TipoMantenimiento' => 'string',
    ];

    /**
     * Define la relación con el modelo Ticket.
     * Un Soporte pertenece a un Ticket.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'idTicket');
    }
}