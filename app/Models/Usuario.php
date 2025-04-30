<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $idUsuario
 * @property int $idRol
 * @property int $idDependencia
 * @property string $Nombre
 * @property string $Username
 * @property string $Password
 * @property string $Telefono
 * 
 * @property Dependencia $dependencia
 * @property Role $role
 * @property Collection|GestionSolicitude[] $gestion_solicitudes
 * @property Collection|GestionSoporte[] $gestion_soportes
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'idUsuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUsuario' => 'int',
		'idRol' => 'int',
		'idDependencia' => 'int'
	];

	protected $fillable = [
		'idRol',
		'idDependencia',
		'Nombre',
		'Username',
		'Password',
		'Telefono'
	];

	public function dependencia()
	{
		return $this->belongsTo(Dependencia::class, 'idDependencia');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'idRol');
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
