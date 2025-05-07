<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoSoporteController extends Controller
{
    /**
     * Muestra una lista de los tipos de soporte.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Aquí puedes obtener los datos de los tipos de soporte desde tu base de datos
        $tiposSoporte = [
            'Hardware',
            'Software',
            'Redes',
            'Otros',
        ];

        // Y luego pasar esos datos a una vista
        return view('tipos-soporte.index', ['tiposSoporte' => $tiposSoporte]);
    }

    // Puedes agregar más métodos para otras acciones relacionadas con los tipos de soporte
    // como crear, editar, eliminar, etc.
}