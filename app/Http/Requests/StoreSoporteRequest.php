<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('gestionar_tickets_propios');
    }

    /**
     * Get the validation rules that apply to the request.
     */
   public function rules()
    {
        return [
            'idTicket' => 'required|exists:tickets,idTicket',
            'idEquipo' => 'nullable|exists:equipos,idEquipo', // Añadir esta regla
            'TipoEquipo' => 'required|in:Impresora,Scanner,Monitor,CPU,Otro',
            'TipoSoporte' => 'required|in:Solicitud,Diagnostico,Baja,Otro',
            'TipoMantenimiento' => 'required|in:Preventivo,Correctivo',
            'Cambios' => 'nullable|string',
        ];
    }
}