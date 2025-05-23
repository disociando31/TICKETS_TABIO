<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Soporte;

class UpdateSoporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        $soporte = $this->route('soporte');
        // Verificar si el usuario puede actualizar el ticket asociado
        return $this->user()->can('update', $soporte->ticket);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'TipoEquipo' => 'required|in:Impresora,Scanner,Monitor,CPU,Otro',
            'TipoSoporte' => 'required|in:Solicitud,Diagnostico,Baja,Otro',
            'TipoMantenimiento' => 'required|in:Preventivo,Correctivo',
            'Cambios' => 'nullable|string',
        ];
    }
}