<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TiposSoporte
 * 
 * @property int $idTipoSoporte
 * @property string $TipoSoporte
 * @property string $Estado
 * 
 * @property Collection|Soporte[] $soportes
 *
 * @package App\Models
 */
class TiposSoporte extends Model
{
	protected $table = 'tipos_soporte';
	protected $primaryKey = 'idTipoSoporte';
	public $timestamps = false;

	protected $fillable = [
		'TipoSoporte',
		'Estado'
	];

	public function soportes()
	{
		return $this->hasMany(Soporte::class, 'idTipoSoporte');
	}
}
