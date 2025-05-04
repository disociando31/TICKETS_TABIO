<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfigRed
 * 
 * @property int $idConfigRed
 * @property int $idEquipo
 * @property string $MAC
 * @property string $IP
 * 
 * @property Equipo $equipo
 *
 * @package App\Models
 */
class ConfigRed extends Model
{
	protected $table = 'config_red';
	protected $primaryKey = 'idConfigRed';
	public $timestamps = false;

	protected $casts = [
		'idEquipo' => 'int'
	];

	protected $fillable = [
		'idEquipo',
		'MAC',
		'IP'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'idEquipo');
	}
}
