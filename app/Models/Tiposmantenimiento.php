<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposmantenimiento
 * 
 * @property int $idTipoMantenimiento
 * @property string $TipoMantenimiento
 * @property string $Estado
 * 
 * @property Collection|Soporte[] $soportes
 *
 * @package App\Models
 */
class Tiposmantenimiento extends Model
{
	protected $table = 'tiposmantenimiento';
	protected $primaryKey = 'idTipoMantenimiento';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTipoMantenimiento' => 'int'
	];

	protected $fillable = [
		'TipoMantenimiento',
		'Estado'
	];

	public function soportes()
	{
		return $this->hasMany(Soporte::class, 'idTipoMantenimiento');
	}
}
