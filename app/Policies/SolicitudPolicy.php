<?php

namespace App\Policies;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolicitudPolicy
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
    public function view(User $user, Solicitud $solicitud)
    {
        // Usar la misma lógica que para el ticket asociado
        return $user->can('view', $solicitud->ticket);
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
    public function update(User $user, Solicitud $solicitud)
    {
        // Usar la misma lógica que para el ticket asociado
        return $user->can('update', $solicitud->ticket);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Solicitud $solicitud)
    {
        return $user->hasRole('Administrador');
    }
}