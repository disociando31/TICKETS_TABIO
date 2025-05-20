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
                   value="{{ old('FechaAdquisicion', $equipo->FechaAdquisicion) }}">
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
                               name="hardware[{{ $index }}][Componente]" 
                               placeholder="Componente" 
                               value="{{ old('hardware.'.$index.'.Componente', $hw->Componente) }}"
                               required>
                        <input type="text" 
                               name="hardware[{{ $index }}][Descripcion]" 
                               placeholder="Descripción" 
                               value="{{ old('hardware.'.$index.'.Descripcion', $hw->Descripcion) }}"
                               required>
                        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
                    </div>
                @empty
                    <div class="hardware-item">
                        <input type="text" name="hardware[0][NumeroPlaca]" placeholder="Número de Placa" required>
                        <input type="text" name="hardware[0][ModeloCPU]" placeholder="Modelo CPU" required>
                        <input type="text" name="hardware[0][SerialCPU]" placeholder="Serial CPU" required>
                        <input type="text" name="hardware[0][Componente]" placeholder="Componente" required>
                        <input type="text" name="hardware[0][Descripcion]" placeholder="Descripción" required>
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
                               name="software_instalados[{{ $index }}][Nombre]" 
                               placeholder="Nombre del Software" 
                               value="{{ old('software_instalados.'.$index.'.Nombre', $software->Nombre) }}">
                        <input type="text" 
                               name="software_instalados[{{ $index }}][Version]" 
                               placeholder="Versión" 
                               value="{{ old('software_instalados.'.$index.'.Version', $software->Version) }}">
                        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
                    </div>
                @empty
                    <div class="software-item">
                        <input type="text" name="software_instalados[0][Nombre]" placeholder="Nombre del Software">
                        <input type="text" name="software_instalados[0][Version]" placeholder="Versión">
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
        <input type="text" 
               name="hardware[${hardwareCount}][NumeroPlaca]" 
               placeholder="Número de Placa" 
               required>
        <input type="text" 
               name="hardware[${hardwareCount}][ModeloCPU]" 
               placeholder="Modelo CPU"
               required>
        <input type="text" 
               name="hardware[${hardwareCount}][SerialCPU]" 
               placeholder="Serial CPU"
               required>
        <input type="text" 
               name="hardware[${hardwareCount}][Componente]" 
               placeholder="Componente"
               required>
        <input type="text" 
               name="hardware[${hardwareCount}][Descripcion]" 
               placeholder="Descripción"
               required>
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
        <input type="text" name="software_instalados[${softwareCount}][Nombre]" placeholder="Nombre del Software">
        <input type="text" name="software_instalados[${softwareCount}][Version]" placeholder="Versión">
        <button type="button" onclick="this.parentElement.remove()" class="btn-remove">Eliminar</button>
    `;
    container.appendChild(newItem);
    softwareCount++;
}
</script>
@endsection