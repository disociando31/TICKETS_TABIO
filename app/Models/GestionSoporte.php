<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GestionSoporte
 * 
 * @property int $idGestion
 * @property int $idSoporte
 * @property int $idUsuario
 * @property string|null $Cambios
 * 
 * @property Soporte $soporte
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class GestionSoporte extends Model
{
	protected $table = 'gestion_soportes';
	protected $primaryKey = 'idGestion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idGestion' => 'int',
		'idSoporte' => 'int',
		'idUsuario' => 'int'
	];

	protected $fillable = [
		'idSoporte',
		'idUsuario',
		'Cambios'
	];

	public function soporte()
	{
		return $this->belongsTo(Soporte::class, 'idSoporte');
	}

	public function usuario()
	{
		return $this->belongsTo(User::class, 'idUsuario');
	}
}
