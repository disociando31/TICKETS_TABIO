<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposequipo
 * 
 * @property int $idTipoEquipo
 * @property string $TipoEquipo
 * @property string $Estado
 * 
 * @property Collection|Soporte[] $soportes
 *
 * @package App\Models
 */
class Tiposequipo extends Model
{
	protected $table = 'tiposequipo';
	protected $primaryKey = 'idTipoEquipo';
	public $timestamps = false;

	protected $fillable = [
		'TipoEquipo',
		'Estado'
	];

	public function soportes()
	{
		return $this->hasMany(Soporte::class, 'idTipoEquipo');
	}
}
