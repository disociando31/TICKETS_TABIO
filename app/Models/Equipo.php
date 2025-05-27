<?php

/**
 * Created by Reliese Model.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'idEquipo';
    public $timestamps = false;

    protected $casts = [
        'idDependencia' => 'int',
        'FechaAdquisicion' => 'datetime',
    ];

    protected $fillable = [
        'idDependencia',
        'NombreEquipo',
        'FechaAdquisicion',
    ];

    // Relaciones

    public function dependencia(): BelongsTo
    {
        return $this->belongsTo(Dependencia::class, 'idDependencia');
    }

    public function configRed(): HasMany
    {
        return $this->hasMany(ConfigRed::class, 'idEquipo');
    }

    public function hardware(): HasMany
    {
        return $this->hasMany(Hardware::class, 'idEquipo');
    }

    public function software_instalados(): HasMany
    {
        return $this->hasMany(SoftwareInstalado::class, 'idEquipo');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Soporte::class, 'idEquipo');
    }
}
