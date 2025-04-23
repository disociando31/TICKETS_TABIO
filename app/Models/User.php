<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'idUsuario';

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

    public $incrementing = true;
    protected $keyType = 'int';

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'idDependencia');
    }
}
