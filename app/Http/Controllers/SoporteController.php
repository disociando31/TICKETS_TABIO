<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SoporteController extends Controller
{
    public function index()
    {
        $soportes = Soporte::all();
        return view('soportes.index', compact('soportes')); // Asume que tienes una vista en 'resources/views/soportes/index.blade.php'
    }

    public function create()
    {
        // Aquí podrías pasar datos necesarios para el formulario, como listas de selección.
        return view('soportes.create'); // Asume que tienes una vista en 'resources/views/soportes/create.blade.php'
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idTicket' => 'nullable|integer|exists:tickets,idTicket',
                'TipoEquipo' => 'required|in:Impresora,Scanner,Monitor,CPU,Otro',
                'TipoSoporte' => 'required|in:Solicitud,Diagnostico,Baja,Otro',
                'TipoMantenimiento' => 'required|in:Preventivo,Correctivo',
            ]);

            Soporte::create($request->all());

            return redirect()->route('soportes.index')->with('success', 'Soporte creado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Error al crear soporte: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear el soporte.');
        }
    }

    public function show(Soporte $soporte)
    {
        return view('soportes.show', compact('soporte')); // Asume que tienes una vista en 'resources/views/soportes/show.blade.php'
    }

    public function edit(Soporte $soporte)
    {
        // Aquí podrías pasar datos necesarios para el formulario de edición.
        return view('soportes.edit', compact('soporte')); // Asume que tienes una vista en 'resources/views/soportes/edit.blade.php'
    }

    public function update(Request $request, Soporte $soporte)
    {
        try {
            $request->validate([
                'idTicket' => 'nullable|integer|exists:tickets,idTicket',
                'TipoEquipo' => 'required|in:Impresora,Scanner,Monitor,CPU,Otro',
                'TipoSoporte' => 'required|in:Solicitud,Diagnostico,Baja,Otro',
                'TipoMantenimiento' => 'required|in:Preventivo,Correctivo',
            ]);

            $soporte->update($request->all());

            return redirect()->route('soportes.index')->with('success', 'Soporte actualizado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Error al actualizar soporte: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el soporte.');
        }
    }

    public function destroy(Soporte $soporte)
    {
        try {
            $soporte->delete();
            return redirect()->route('soportes.index')->with('success', 'Soporte eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar soporte: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el soporte.');
        }
    }
}