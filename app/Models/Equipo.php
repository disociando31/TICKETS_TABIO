<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipo
 * 
 * @property int $idEquipo
 * @property int $idDependencia
 * @property string $NombreEquipo
 * @property Carbon $FechaAdquisicion
 * 
 * @property Dependencia $dependencia
 * @property Collection|ConfigRed[] $config_reds
 * @property Collection|Hardware[] $hardware
 * @property Collection|SoftwareInstalado[] $software_instalados
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
 */
class Equipo extends Model
{
	protected $table = 'equipos';
	protected $primaryKey = 'idEquipo';
	public $timestamps = false;

	protected $casts = [
		'idDependencia' => 'int',
		'FechaAdquisicion' => 'datetime'
	];

	protected $fillable = [
		'idDependencia',
		'NombreEquipo',
		'FechaAdquisicion'
	];

	public function dependencia()
	{
		return $this->belongsTo(Dependencia::class, 'idDependencia');
	}

	public function config_reds()
	{
		return $this->hasMany(ConfigRed::class, 'idEquipo');
	}

	public function hardware()
	{
		return $this->hasMany(Hardware::class, 'idEquipo');
	}

	public function software_instalados()
	{
		return $this->hasMany(SoftwareInstalado::class, 'idEquipo');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'idEquipo');
	}
}
