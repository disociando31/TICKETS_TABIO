<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposasistencia
 * 
 * @property int $idTipoAsistencia
 * @property string $TipoAsistencia
 * @property string $Estado
 * 
 * @property Collection|Solicitude[] $solicitudes
 *
 * @package App\Models
 */
class Tiposasistencia extends Model
{
	protected $table = 'tiposasistencia';
	protected $primaryKey = 'idTipoAsistencia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTipoAsistencia' => 'int'
	];

	protected $fillable = [
		'TipoAsistencia',
		'Estado'
	];

	public function solicitudes()
	{
		return $this->hasMany(Solicitude::class, 'idTipoAsistencia');
	}
}
