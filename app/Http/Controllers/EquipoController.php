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
public function update(Request $request, $id)
{
    $equipo = Equipo::findOrFail($id);

    $equipo->update($request->only(['idDependencia', 'NombreEquipo', 'FechaAdquisicion']));

    // Puedes optar por borrar y volver a crear los elementos relacionados (más sencillo)
    $equipo->configRed()->delete();
    $equipo->hardware()->delete();
    $equipo->software_instalados()->delete();

    if ($request->has('configRed')) {
        $equipo->configRed()->createMany($request->input('configRed'));
    }

    if ($request->has('hardware')) {
        $equipo->hardware()->createMany($request->input('hardware'));
    }

    if ($request->has('software_instalados')) {
        $equipo->software_instalados()->createMany($request->input('software_instalados'));
    }

    return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
}
}