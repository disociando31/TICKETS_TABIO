<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolicitudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        $user = $this->user();
        if (!$user) return false;
        return $user->hasPermissionTo('gestionar_tickets_propios');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'idTicket' => 'required|exists:tickets,idTicket',
            'idTipoAsistencia' => 'required|exists:tiposasistencia,idTipoAsistencia',
            'Aplicacion' => 'nullable|string|max:255',
            'ElementosAfectados' => 'nullable|string',
            'Cambios' => 'nullable|string',
        ];
    }
}