<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitude
 * 
 * @property int $idSolicitud
 * @property int $idTicket
 * @property int $idTipoAsistencia
 * @property string $Aplicacion
 * @property string $ElementosAfectados
 * 
 * @property Ticket $ticket
 * @property Tiposasistencium $tiposasistencium
 * @property Collection|GestionSolicitude[] $gestion_solicitudes
 *
 * @package App\Models
 */
class Solicitud extends Model
{
	protected $table = 'solicitudes';
	protected $primaryKey = 'idSolicitud';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idSolicitud' => 'int',
		'idTicket' => 'int',
		'idTipoAsistencia' => 'int'
	];

	protected $fillable = [
		'idTicket',
		'idTipoAsistencia',
		'Aplicacion',
		'ElementosAfectados'
	];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class, 'idTicket');
	}

	public function tiposasistencium()
	{
		return $this->belongsTo(Tipoasistencia::class, 'idTipoAsistencia');
	}

	public function gestion_solicitudes()
	{
		return $this->hasMany(GestionSolicitud::class, 'idSolicitud');
	}
}
