<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hardware
 * 
 * @property int $idHardware
 * @property int $idEquipo
 * @property string $NumeroPlaca
 * @property string $ModeloCPU
 * @property string $SerialCPU
 * @property string $Procesador
 * @property string $RAM
 * @property string $HDD
 * @property string $Monitor
 * @property string $SerialMonitor
 * @property string $Teclado
 * @property string $SerialTeclado
 * @property string $Mouse
 * @property string $SerialMouse
 * 
 * @property Equipo $equipo
 *
 * @package App\Models
 */
class Hardware extends Model
{
	protected $table = 'hardware';
	protected $primaryKey = 'idHardware';
	public $timestamps = false;

	protected $casts = [
		'idEquipo' => 'int'
	];

	protected $fillable = [
		'idEquipo',
		'NumeroPlaca',
		'ModeloCPU',
		'SerialCPU',
		'Procesador',
		'RAM',
		'HDD',
		'Monitor',
		'SerialMonitor',
		'Teclado',
		'SerialTeclado',
		'Mouse',
		'SerialMouse'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'idEquipo');
	}
}
