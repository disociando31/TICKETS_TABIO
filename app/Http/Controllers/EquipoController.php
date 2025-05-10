<?php
namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\dependencia;
use App\Models\configRed;
use App\Models\hardware;
use App\Models\software_instalados;
use App\Models\tickets;
use Illuminate\Http\Request;
class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::with(['dependencia', 'configRed', 'hardware', 'software_instalados'])->get();
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function edit($id)
    {
        $equipo = Equipo::with(['dependencia', 'configRed', 'hardware', 'software_instalados'])->findOrFail($id);
        return view('equipos.edit', compact('equipo'));
    }   
public function store(Request $request)
{
    // Crear el equipo principal
    $equipo = Equipo::create($request->only(['idDependencia', 'NombreEquipo', 'FechaAdquisicion']));

    // Crear múltiples configuraciones de red
    if ($request->has('configRed')) {
        $equipo->configRed()->createMany($request->input('configRed'));
    }

    // Crear múltiples componentes de hardware
    if ($request->has('hardware')) {
        $equipo->hardware()->createMany($request->input('hardware'));
    }

    // Crear múltiples software instalados
    if ($request->has('software_instalados')) {
        $equipo->software_instalados()->createMany($request->input('software_instalados'));
    }

    return redirect()->route('equipos.index')->with('success', 'Equipo creado exitosamente.');
}

public function configRed($id)
{
    $equipo = Equipo::with('configRed')->findOrFail($id);
    return view('equipos.configRed', compact('equipo'));
}

public function hardware($id)
{
    $equipo = Equipo::with('hardware')->findOrFail($id);
    return view('equipos.hardware', compact('equipo'));
}

public function software_instalados($id)
{
    $equipo = Equipo::with('software_instalados')->findOrFail($id);
    return view('equipos.software_instalados', compact('equipo'));
}

public function tickets($id)
{
    $equipo = Equipo::with('tickets')->findOrFail($id);
    return view('equipos.tickets', compact('equipo'));
}
}