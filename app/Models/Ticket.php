<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $idTicket
 * @property string $Estado
 * @property int $idUsuario
 * @property string $Prioridad
 * @property string $Tipo
 * @property int|null $idEquipo
 * @property string $Descripcion
 * @property Carbon $FechaCreacion
 * @property Carbon|null $FechaCierre
 * 
 * @property Equipo|null $equipo
 * @property Usuario $usuario
 * @property Collection|Solicitude[] $solicitudes
 * @property Collection|Soporte[] $soportes
 *
 * @package App\Models
 */
class Ticket extends Model
{
	protected $table = 'tickets';
	protected $primaryKey = 'idTicket';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTicket' => 'int',
		'idUsuario' => 'int',
		'idEquipo' => 'int',
		'FechaCreacion' => 'datetime',
		'FechaCierre' => 'datetime'
	];

	protected $fillable = [
		'Estado',
		'idUsuario',
		'Prioridad',
		'Tipo',
		'idEquipo',
		'Descripcion',
		'FechaCreacion',
		'FechaCierre'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'idEquipo');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idUsuario');
	}

	public function solicitudes()
	{
		return $this->hasMany(Solicitude::class, 'idTicket');
	}

	public function soportes()
	{
		return $this->hasMany(Soporte::class, 'idTicket');
	}
}
