<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('ticket'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $user = $this->user();
        
        // Reglas diferentes según el rol
        if ($user->hasRole('Usuario')) {
            return [
                'Prioridad' => 'required|in:Prioritario,Urgente,Regular',
                'Tipo' => 'required|in:Solicitud de servicio,Soporte',
                'action' => 'nullable|string|in:save,continue_soporte,continue_solicitud', // Agregado
            ];
        } else if ($user->hasRole('Trabajador')) {
            return [
                'Prioridad' => 'required|in:Prioritario,Urgente,Regular',
                'Tipo' => 'required|in:Solicitud de servicio,Soporte',
                'Estado' => 'required|in:Abierto,Cerrado',
                'Descripcion' => 'required|string|max:255',
                'Cambios' => 'nullable|string',
                'action' => 'nullable|string|in:save,continue_soporte,continue_solicitud', // Agregado
                // No incluimos idGestor en la validación para trabajadores
            ];
        } else {
            // Admin puede editar todo
            return [
                'Prioridad' => 'required|in:Prioritario,Urgente,Regular',
                'Tipo' => 'required|in:Solicitud de servicio,Soporte',
                'Estado' => 'required|in:Abierto,Cerrado',
                'Descripcion' => 'required|string|max:255',
                'idGestor' => 'nullable|exists:users,idUsuario',
                'Cambios' => 'nullable|string',
                'action' => 'nullable|string|in:save,continue_soporte,continue_solicitud', // Agregado
            ];
        }
    }
}