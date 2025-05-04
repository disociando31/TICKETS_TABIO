<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Collection;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false; // Igual que en Usuario

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
        'idUsuario' => 'int',
        'idDependencia' => 'int'
    ];

    public $incrementing = true;
    protected $keyType = 'int';

    // Relaciones

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'idDependencia');
    }

    public function gestion_solicitudes()
    {
        return $this->hasMany(GestionSolicitude::class, 'idUsuario');
    }

    public function gestion_soportes()
    {
        return $this->hasMany(GestionSoporte::class, 'idUsuario');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'idUsuario');
    }
}