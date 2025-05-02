<?php


namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Añadir el campo 'estado' a los fillable
    protected $fillable = ['name', 'guard_name', 'estado'];
    
    /**
     * Obtiene solo los roles activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', true);
    }

}
