<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dependencia
 * 
 * @property int $idDependencia
 * @property int $Dependencia
 * @property string $Estado
 * 
 * @property Collection|Equipo[] $equipos
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Dependencia extends Model
{
	protected $table = 'dependencias';
	protected $primaryKey = 'idDependencia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idDependencia' => 'int',
		'Dependencia' => 'string'
	];

	protected $fillable = [
		'Dependencia',
		'Estado'
	];

	public function equipos()
	{
		return $this->hasMany(Equipo::class, 'idDependencia');
	}

	public function usuarios()
	{
		return $this->hasMany(User::class, 'idDependencia');
	}
}
