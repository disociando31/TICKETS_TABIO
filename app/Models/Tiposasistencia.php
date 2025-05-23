<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Tiposasistencia extends Model
{
	protected $table = 'tiposasistencia';
	protected $primaryKey = 'idTipoAsistencia';
	public $incrementing = true;
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
		return $this->hasMany(Solicitud::class, 'idTipoAsistencia');
	}
}
