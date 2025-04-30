<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $idRol
 * @property int $Rol
 * @property string $Estado
 * 
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'idRol';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idRol' => 'int',
		'Rol' => 'int'
	];

	protected $fillable = [
		'Rol',
		'Estado'
	];

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'idRol');
	}
}
