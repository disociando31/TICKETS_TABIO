<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dependencia extends Model
{
    protected $table = 'dependencias';
    protected $primaryKey = 'idDependencia';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'dependencia',
        'Estado',
    ];

    /**
     * Get the usuarios associated with the dependencia.
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, 'idDependencia', 'idDependencia');
    }
}
