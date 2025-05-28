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
        $equipos = Equipo::all();
        return view('Equipos.index', compact('equipos'));
    }

    public function create()
    {
        $dependencias = Dependencia::where('Estado', 'A')->get();
        return view('Equipos.create', compact('dependencias'));
    }
    
    public function edit($id)
    {
        $equipo = Equipo::with(['dependencia', 'configRed', 'hardware', 'software_instalados'])->findOrFail($id);
        $dependencias = Dependencia::where('Estado', 'A')->get();
        return view('Equipos.edit', compact('equipo', 'dependencias'));
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
        $equipo = Equipo::with([
            'configRed' => function($query) {
                $query->orderBy('idConfigRed', 'desc');
            }
        ])->findOrFail($id);
        
        // Separar configuración actual (más reciente) del historial
        $configActual = $equipo->configRed->first(); // El primero es el más reciente
        $historialConfig = $equipo->configRed->skip(1); // El resto es historial
        
        return view('Equipos.configRed', compact('equipo', 'configActual', 'historialConfig'));
    }

    public function hardware($id)
    {
        $equipo = Equipo::with([
            'hardware' => function($query) {
                $query->orderBy('idHardware', 'desc');
            }
        ])->findOrFail($id);
        
        // Separar configuración actual (más reciente) del historial
        $hardwareActual = $equipo->hardware->first(); // El primero es el más reciente
        $historialHardware = $equipo->hardware->skip(1); // El resto es historial
        
        return view('Equipos.hardware', compact('equipo', 'hardwareActual', 'historialHardware'));
    }

    public function software_instalados($id)
    {
        $equipo = Equipo::with([
            'software_instalados' => function($query) {
                $query->orderBy('idSoftwareInstalado', 'desc');
            }
        ])->findOrFail($id);
        
        // Separar configuración actual (más reciente) del historial
        $softwareActual = $equipo->software_instalados->first(); // El primero es el más reciente
        $historialSoftware = $equipo->software_instalados->skip(1); // El resto es historial
        
        return view('Equipos.software_instalados', compact('equipo', 'softwareActual', 'historialSoftware'));
    }

    public function tickets($id)
    {
        $equipo = Equipo::with([
            // Cargar los soportes asociados al equipo
            'tickets' => function($query) {
                $query->orderBy('idSoporte', 'desc');
            },
            // Cargar el ticket asociado a cada soporte
            'tickets.ticket' => function($query) {
                $query->select('idTicket', 'Estado', 'FechaCreacion', 'idUsuario', 'idGestor', 'Descripcion', 'Prioridad', 'Tipo');
            },
            // Cargar información del usuario creador del ticket
            'tickets.ticket.usuario' => function($query) {
                $query->select('idUsuario', 'nombre', 'idDependencia');
            }
        
        ])->findOrFail($id);

        return view('Equipos.tickets', compact('equipo'));
    }
    
    public function show($id)
    {
        $equipo = Equipo::with([
            'dependencia',
            // Cargar solo la configuración de red más reciente
            'configRed' => function($query) {
                $query->orderBy('idConfigRed', 'desc')->limit(1);
            },
            // Cargar solo el hardware más reciente
            'hardware' => function($query) {
                $query->orderBy('idHardware', 'desc')->limit(1);
            },
            // Cargar solo el software más reciente
            'software_instalados' => function($query) {
                $query->orderBy('idSoftwareInstalado', 'desc')->limit(1);
            }
        ])->findOrFail($id);
        
        return view('Equipos.show', compact('equipo'));
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
