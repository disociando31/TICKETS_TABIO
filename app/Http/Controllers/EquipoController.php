<?php
namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Dependencia;
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
        $dependencias = Dependencia::where('Estado', 'A')->get();
        return view('equipos.create', compact('dependencias'));
    }
    
    public function edit($id)
    {
        $equipo = Equipo::with(['dependencia', 'configRed', 'hardware', 'software_instalados'])->findOrFail($id);
        $dependencias = Dependencia::where('Estado', 'A')->get();
        return view('equipos.edit', compact('equipo', 'dependencias'));
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

    public function show($id)
    {
        $equipo = Equipo::with(['dependencia', 'configRed', 'hardware', 'software_instalados'])->findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }

    public function update(Request $request, $id)
    {
    // Validar la solicitud
    $request->validate([
        'NombreEquipo' => 'required|string|max:255',
        'idDependencia' => 'required|exists:dependencias,idDependencia',
        'FechaAdquisicion' => 'nullable|date',
    ]);

    // Buscar el equipo
    $equipo = Equipo::findOrFail($id);

    // Actualizar los datos principales del equipo
    $equipo->update($request->only(['idDependencia', 'NombreEquipo', 'FechaAdquisicion']));

    // Actualizar config_red (eliminar existentes y crear nuevos)
    if ($request->has('configRed')) {
        $equipo->configRed()->delete();
        foreach ($request->input('configRed') as $configData) {
            if (!empty($configData['MAC']) || !empty($configData['IP'])) {
                $equipo->configRed()->create($configData);
            }
        }
    }

    // Actualizar hardware (eliminar existentes y crear nuevos)
    if ($request->has('hardware')) {
        $equipo->hardware()->delete();
        foreach ($request->input('hardware') as $hardwareData) {
            // Solo crear si al menos un campo está lleno
            if (array_filter($hardwareData)) {
                $equipo->hardware()->create($hardwareData);
            }
        }
    }

    // Actualizar software_instalados (eliminar existentes y crear nuevos)
    if ($request->has('software_instalados')) {
        $equipo->software_instalados()->delete();
        foreach ($request->input('software_instalados') as $softwareData) {
            // Solo crear si al menos un campo está lleno
            if (array_filter($softwareData)) {
                $equipo->software_instalados()->create($softwareData);
            }
        }
    }

    return redirect()->route('equipos.index')->with('success', 'Equipo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);

        $equipo->hardware()->delete();
        $equipo->software_instalados()->delete();
        if ($equipo->configRed) {
            $equipo->configRed()->delete();
        }

        $equipo->delete();

        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado.');
    }
}
