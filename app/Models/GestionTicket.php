<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GestionTicket extends Model
{
    

    protected $table = 'gestion_tickets';
    protected $primaryKey = 'idGestion';
    public $incrementing = true;
    public $timestamps = true;

    
    protected $fillable = [
        'idTicket',
        'Cambios',
    ];
    
    protected $casts = [
        'idGestion' => 'int',
        'idTicket' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Define la relación con el modelo Ticket
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'idTicket');
    }
}