<?php

namespace App\Policies;

use App\Models\Soporte;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SoportePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('gestionar_tickets_propios');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Soporte $soporte)
    {
        // Usar la misma lógica que para el ticket asociado
        return $user->can('view', $soporte->ticket);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('gestionar_tickets_propios');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Soporte $soporte)
    {
        // Usar la misma lógica que para el ticket asociado
        return $user->can('update', $soporte->ticket);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Soporte $soporte)
    {
        return $user->hasRole('Administrador');
    }
}