<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Soporte
 * 
 * @property int $idSoporte
 * @property int|null $idTicket
 * @property int $idTipoEquipo
 * @property int $idTipoSoporte
 * @property int $idTipoMantenimiento
 * 
 * @property Ticket|null $ticket
 * @property Tiposequipo $tiposequipo
 * @property Tiposmantenimiento $tiposmantenimiento
 * @property TiposSoporte $tipos_soporte
 * @property Collection|GestionSoporte[] $gestion_soportes
 *
 * @package App\Models
 */
class Soporte extends Model
{
	protected $table = 'soportes';
	protected $primaryKey = 'idSoporte';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idSoporte' => 'int',
		'idTicket' => 'int',
		'idTipoEquipo' => 'int',
		'idTipoSoporte' => 'int',
		'idTipoMantenimiento' => 'int'
	];

	protected $fillable = [
		'idTicket',
		'idTipoEquipo',
		'idTipoSoporte',
		'idTipoMantenimiento'
	];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class, 'idTicket');
	}

	public function tiposequipo()
	{
		return $this->belongsTo(Tiposequipo::class, 'idTipoEquipo');
	}

	public function tiposmantenimiento()
	{
		return $this->belongsTo(Tiposmantenimiento::class, 'idTipoMantenimiento');
	}

	public function tipos_soporte()
	{
		return $this->belongsTo(TiposSoporte::class, 'idTipoSoporte');
	}

	public function gestion_soportes()
	{
		return $this->hasMany(GestionSoporte::class, 'idSoporte');
	}
}
