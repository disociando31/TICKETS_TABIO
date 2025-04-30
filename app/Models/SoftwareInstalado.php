<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SoftwareInstalado
 * 
 * @property int $idSoftwareInstalado
 * @property int $idEquipo
 * @property string $SistemaOperativo
 * @property string $LicSuiteOfimatica
 * @property string $SuiteOfimatica
 * @property string $LicAntivirus
 * @property string $Antivirus
 * 
 * @property Equipo $equipo
 *
 * @package App\Models
 */
class SoftwareInstalado extends Model
{
	protected $table = 'software_instalado';
	protected $primaryKey = 'idSoftwareInstalado';
	public $timestamps = false;

	protected $casts = [
		'idEquipo' => 'int'
	];

	protected $fillable = [
		'idEquipo',
		'SistemaOperativo',
		'LicSuiteOfimatica',
		'SuiteOfimatica',
		'LicAntivirus',
		'Antivirus'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'idEquipo');
	}
}
