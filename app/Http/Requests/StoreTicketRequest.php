<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'Tipo' => 'required|in:Solicitud de servicio,Soporte',
            'Descripcion' => 'required|string|max:255',
        ];
    }
}