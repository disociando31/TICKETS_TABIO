<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GestionSolicitude
 * 
 * @property int $idGestion
 * @property int $idSolicitud
 * @property int $idUsuario
 * @property string|null $Cambios
 * 
 * @property Solicitude $solicitude
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class GestionSolicitud extends Model
{
	protected $table = 'gestion_solicitudes';
	protected $primaryKey = 'idGestion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idGestion' => 'int',
		'idSolicitud' => 'int',
		'idUsuario' => 'int'
	];

	protected $fillable = [
		'idSolicitud',
		'idUsuario',
		'Cambios'
	];

	public function solicitude()
	{
		return $this->belongsTo(Solicitud::class, 'idSolicitud');
	}

	public function usuario()
	{
		return $this->belongsTo(User::class, 'idUsuario');
	}
}
