<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soporte; // Asumiendo que tienes un modelo Soporte

class SoporteController extends Controller
{
    public function index()
    {
        $soportes = Soporte::all();
        return view('soportes.index', compact('soportes'));
    }

    public function create()
    {
        return view('soportes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idTicket' => 'required|integer',
            'TipoEquipo' => 'required|in:Computadora,Laptop,Impresora,Router',
            'TipoSoporte' => 'required|in:Hardware,Software,Red',
            'TipoMantenimiento' => 'required|in:Preventivo,Correctivo',
            'idEquipo' => 'required|integer',
        ]);

        $soporte = new Soporte();
        $soporte->idTicket = $request->idTicket;
        $soporte->TipoEquipo = $request->TipoEquipo;
        $soporte->TipoSoporte = $request->TipoSoporte;
        $soporte->TipoMantenimiento = $request->TipoMantenimiento;
        $soporte->idEquipo = $request->idEquipo;
        $soporte->save();

        return redirect()->route('soportes.index')->with('success', 'Soporte creado correctamente.');
    }

    public function show($id)
    {
        $soporte = Soporte::find($id);
        if (!$soporte) {
            abort(404);
        }
        return view('soportes.show', compact('soporte'));
    }

    public function edit($id)
    {
        $soporte = Soporte::find($id);
        if (!$soporte) {
            abort(404);
        }
        return view('soportes.edit', compact('soporte'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idTicket' => 'required|integer',
            'TipoEquipo' => 'required|in:Computadora,Laptop,Impresora,Router',
            'TipoSoporte' => 'required|in:Hardware,Software,Red',
            'TipoMantenimiento' => 'required|in:Preventivo,Correctivo',
            'idEquipo' => 'required|integer',
        ]);

        $soporte = Soporte::find($id);
        if (!$soporte) {
            abort(404);
        }

        $soporte->idTicket = $request->idTicket;
        $soporte->TipoEquipo = $request->TipoEquipo;
        $soporte->TipoSoporte = $request->TipoSoporte;
        $soporte->TipoMantenimiento = $request->TipoMantenimiento;
        $soporte->idEquipo = $request->idEquipo;
        $soporte->save();

        return redirect()->route('soportes.index')->with('success', 'Soporte actualizado correctamente.');
    }

    public function destroy($id)
    {
        $soporte = Soporte::find($id);
        if (!$soporte) {
            abort(404);
        }
        $soporte->delete();

        return redirect()->route('soportes.index')->with('success', 'Soporte eliminado correctamente.');
    }
}