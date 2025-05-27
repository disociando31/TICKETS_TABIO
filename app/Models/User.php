<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table        = 'users';
    protected $primaryKey   = 'idUsuario';
    public    $incrementing = true;
    public    $timestamps   = false;
    protected $keyType      = 'int';

    protected $fillable = [
        'nombre',
        'username',
        'password',
        'telefono',
        'idDependencia',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'idUsuario'      => 'int',
        'idDependencia'  => 'int',
    ];

    /** La dependencia/área a la que pertenece */
    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'idDependencia');
    }

    /** Tickets que este usuario ha creado */
    public function ticketsCreados()
    {
        return $this->hasMany(Ticket::class, 'idUsuario', 'idUsuario');
    }

    /** Tickets que este usuario gestiona/soluciona */
    public function ticketsGestionados()
    {
        return $this->hasMany(Ticket::class, 'idGestor', 'idUsuario');
    }
}
