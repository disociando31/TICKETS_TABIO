<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tickets.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('gestionar_tickets_propios');
    }

    /**
     * Determine whether the user can view the ticket.
     */
    public function view(User $user, Ticket $ticket)
    {
        // Admin puede ver cualquier ticket
        if ($user->hasRole('Administrador')) {
            return true;
        }
        
        // Trabajador puede ver tickets que creó o le fueron asignados
        if ($user->hasRole('Trabajador')) {
            return $ticket->idUsuario == $user->idUsuario || 
                   $ticket->idGestor == $user->idUsuario;
        }
        
        // Usuario solo puede ver sus propios tickets
        return $ticket->idUsuario == $user->idUsuario;
    }

    /**
     * Determine whether the user can create tickets.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('gestionar_tickets_propios');
    }

    /**
     * Determine whether the user can update the ticket.
     */
    public function update(User $user, Ticket $ticket)
    {
        // Admin puede actualizar cualquier ticket
        if ($user->hasRole('Administrador')) {
            return true;
        }
        
        // Trabajador puede actualizar tickets que creó o le fueron asignados
        if ($user->hasRole('Trabajador')) {
            return $ticket->idUsuario == $user->idUsuario || 
                   $ticket->idGestor == $user->idUsuario;
        }
        
        // Usuario solo puede actualizar sus propios tickets
        return $ticket->idUsuario == $user->idUsuario;
    }

    /**
     * Determine whether the user can delete the ticket.
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->hasRole('Administrador');
    }
}