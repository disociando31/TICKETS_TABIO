@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Editar Equipo</h1>
    </div>
    
    @if ($errors->any())
        <div class="error-container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('equipos.update', $equipo->idEquipo) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="NombreEquipo">Nombre del Equipo:</label>
            <input type="text" 
                   id="NombreEquipo" 
                   name="NombreEquipo" 
                   value="{{ old('NombreEquipo', $equipo->NombreEquipo) }}" 
                   required
                   oninvalid="this.setCustomValidity('El nombre del equipo es obligatorio')"
                   oninput="this.setCustomValidity('')">
        </div>

        <div class="form-group">
            <label for="idDependencia">Dependencia:</label>
            <select id="idDependencia" 
                    name="idDependencia" 
                    required
                    oninvalid="this.setCustomValidity('Debe seleccionar una dependencia')"
                    oninput="this.setCustomValidity('')">
                <option value="">Seleccione una dependencia</option>
                @foreach($dependencias as $dependencia)
                    <option value="{{ $dependencia->idDependencia }}" 
                            {{ old('idDependencia', $equipo->idDependencia) == $dependencia->idDependencia ? 'selected' : '' }}>
                        {{ $dependencia->Dependencia }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="FechaAdquisicion">Fecha de Adquisición:</label>
            <input type="date" 
                   id="FechaAdquisicion" 
                   name="FechaAdquisicion" 
                   value="{{ old('FechaAdquisicion', $equipo->FechaAdquisicion ? date('Y-m-d', strtotime($equipo->FechaAdquisicion)) : '') }}">
        </div>

        <div class="form-section">
            <h3>Configuración de Red</h3>
            <div id="configRed-container">
                @forelse($equipo->configRed as $index => $config)
                    <div class="config-red-item">
                        <input type="text" 
                               name="configRed[{{ $index }}][MAC]" 
                               placeholder="Dirección MAC" 
                               value="{{ old('configRed.'.$index.'.MAC', $config->MAC) }}">
                        <input type="text" 
                               name="configRed[{{ $index }}][IP]" 
                               placeholder="Dirección IP" 
                               value="{{ old('configRed.'.$index.'.IP', $config->IP) }}">
                        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
                    </div>
                @empty
                    <div class="config-red-item">
                        <input type="text" name="configRed[0][MAC]" placeholder="Dirección MAC">
                        <input type="text" name="configRed[0][IP]" placeholder="Dirección IP">
                    </div>
                @endforelse
            </div>
            <button type="button" onclick="addConfigRed()" class="btn-add">+ Agregar Configuración de Red</button>
        </div>

        <div class="form-section">
            <h3>Hardware</h3>
            <div id="hardware-container">
                @forelse($equipo->hardware as $index => $hw)
                    <div class="hardware-item">
                        <input type="text" 
                               name="hardware[{{ $index }}][NumeroPlaca]" 
                               placeholder="Número de Placa" 
                               value="{{ old('hardware.'.$index.'.NumeroPlaca', $hw->NumeroPlaca) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][ModeloCPU]" 
                               placeholder="Modelo CPU" 
                               value="{{ old('hardware.'.$index.'.ModeloCPU', $hw->ModeloCPU) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][SerialCPU]" 
                               placeholder="Serial CPU" 
                               value="{{ old('hardware.'.$index.'.SerialCPU', $hw->SerialCPU) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][Procesador]" 
                               placeholder="Procesador" 
                               value="{{ old('hardware.'.$index.'.Procesador', $hw->Procesador) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][RAM]" 
                               placeholder="RAM" 
                               value="{{ old('hardware.'.$index.'.RAM', $hw->RAM) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][HDD]" 
                               placeholder="Disco Duro" 
                               value="{{ old('hardware.'.$index.'.HDD', $hw->HDD) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][Monitor]" 
                               placeholder="Monitor" 
                               value="{{ old('hardware.'.$index.'.Monitor', $hw->Monitor) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][SerialMonitor]" 
                               placeholder="Serial Monitor" 
                               value="{{ old('hardware.'.$index.'.SerialMonitor', $hw->SerialMonitor) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][Teclado]" 
                               placeholder="Teclado" 
                               value="{{ old('hardware.'.$index.'.Teclado', $hw->Teclado) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][SerialTeclado]" 
                               placeholder="Serial Teclado" 
                               value="{{ old('hardware.'.$index.'.SerialTeclado', $hw->SerialTeclado) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][Mouse]" 
                               placeholder="Mouse" 
                               value="{{ old('hardware.'.$index.'.Mouse', $hw->Mouse) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][SerialMouse]" 
                               placeholder="Serial Mouse" 
                               value="{{ old('hardware.'.$index.'.SerialMouse', $hw->SerialMouse) }}"
                               required>
                        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
                    </div>
                @empty
                    <div class="hardware-item">
                        <!-- Mismos campos que arriba pero sin valores -->
                    </div>
                @endforelse
            </div>
            <button type="button" onclick="addHardware()" class="btn-add">+ Agregar Hardware</button>
        </div>

        <div class="form-section">
            <h3>Software Instalado</h3>
            <div id="software-container">
                @forelse($equipo->software_instalados as $index => $software)
                    <div class="software-item">
                        <input type="text" 
                               name="software_instalados[{{ $index }}][SistemaOperativo]" 
                               placeholder="Sistema Operativo" 
                               value="{{ old('software_instalados.'.$index.'.SistemaOperativo', $software->SistemaOperativo) }}">
                        <input type="text" 
                               name="software_instalados[{{ $index }}][LicSuiteOfimatica]" 
                               placeholder="Licencia Suite Ofimática" 
                               value="{{ old('software_instalados.'.$index.'.LicSuiteOfimatica', $software->LicSuiteOfimatica) }}">
                        <input type="text" 
                               name="software_instalados[{{ $index }}][SuiteOfimatica]" 
                               placeholder="Suite Ofimática" 
                               value="{{ old('software_instalados.'.$index.'.SuiteOfimatica', $software->SuiteOfimatica) }}">
                        <input type="text" 
                               name="software_instalados[{{ $index }}][LicAntivirus]" 
                               placeholder="Licencia Antivirus" 
                               value="{{ old('software_instalados.'.$index.'.LicAntivirus', $software->LicAntivirus) }}">
                        <input type="text" 
                               name="software_instalados[{{ $index }}][Antivirus]" 
                               placeholder="Antivirus" 
                               value="{{ old('software_instalados.'.$index.'.Antivirus', $software->Antivirus) }}">
                        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
                    </div>
                @empty
                    <div class="software-item">
                        <!-- Mismos campos que arriba pero sin valores -->
                    </div>
                @endforelse
            </div>
            <button type="button" onclick="addSoftware()" class="btn-add">+ Agregar Software</button>
        </div>

        <div class="buttons-container">
            <button type="submit" class="btn-submit">Actualizar Equipo</button>
            <a href="{{ route('equipos.index') }}" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

<script>
let configRedCount = {{ count($equipo->configRed) }};
let hardwareCount = {{ count($equipo->hardware) }};
let softwareCount = {{ count($equipo->software_instalados) }};

function addConfigRed() {
    const container = document.getElementById('configRed-container');
    const newItem = document.createElement('div');
    newItem.className = 'config-red-item';
    newItem.innerHTML = `
        <input type="text" name="configRed[${configRedCount}][MAC]" placeholder="Dirección MAC">
        <input type="text" name="configRed[${configRedCount}][IP]" placeholder="Dirección IP">
        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
    `;
    container.appendChild(newItem);
    configRedCount++;
}

function addHardware() {
    const container = document.getElementById('hardware-container');
    const newItem = document.createElement('div');
    newItem.className = 'hardware-item';
    newItem.innerHTML = `
        <input type="text" name="hardware[${hardwareCount}][NumeroPlaca]" placeholder="Número de Placa" required>
        <input type="text" name="hardware[${hardwareCount}][ModeloCPU]" placeholder="Modelo CPU" required>
        <input type="text" name="hardware[${hardwareCount}][SerialCPU]" placeholder="Serial CPU" required>
        <input type="text" name="hardware[${hardwareCount}][Procesador]" placeholder="Procesador" required>
        <input type="text" name="hardware[${hardwareCount}][RAM]" placeholder="RAM" required>
        <input type="text" name="hardware[${hardwareCount}][HDD]" placeholder="Disco Duro" required>
        <input type="text" name="hardware[${hardwareCount}][Monitor]" placeholder="Monitor" required>
        <input type="text" name="hardware[${hardwareCount}][SerialMonitor]" placeholder="Serial Monitor" required>
        <input type="text" name="hardware[${hardwareCount}][Teclado]" placeholder="Teclado" required>
        <input type="text" name="hardware[${hardwareCount}][SerialTeclado]" placeholder="Serial Teclado" required>
        <input type="text" name="hardware[${hardwareCount}][Mouse]" placeholder="Mouse" required>
        <input type="text" name="hardware[${hardwareCount}][SerialMouse]" placeholder="Serial Mouse" required>
        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
    `;
    container.appendChild(newItem);
    hardwareCount++;
}

function addSoftware() {
    const container = document.getElementById('software-container');
    const newItem = document.createElement('div');
    newItem.className = 'software-item';
    newItem.innerHTML = `
        <input type="text" name="software_instalados[${softwareCount}][SistemaOperativo]" placeholder="Sistema Operativo">
        <input type="text" name="software_instalados[${softwareCount}][LicSuiteOfimatica]" placeholder="Licencia Suite Ofimática">
        <input type="text" name="software_instalados[${softwareCount}][SuiteOfimatica]" placeholder="Suite Ofimática">
        <input type="text" name="software_instalados[${softwareCount}][LicAntivirus]" placeholder="Licencia Antivirus">
        <input type="text" name="software_instalados[${softwareCount}][Antivirus]" placeholder="Antivirus">
        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
    `;
    container.appendChild(newItem);
    softwareCount++;
}
</script>
@endsection