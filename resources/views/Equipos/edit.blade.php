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
                   value="{{ old('FechaAdquisicion', $equipo->FechaAdquisicion ? date('Y-m-d', strtotime($equipo->FechaAdquisicion)) : '') }}"
                   required
                   oninvalid="this.setCustomValidity('La fecha de adquisición es obligatoria')"
                   oninput="this.setCustomValidity('')">
        </div>

        <div class="form-section">
            <h3>Configuración de Red</h3>
            <div id="configRed-container">
                @php
                    $configRedReciente = $equipo->configRed->sortByDesc('idConfigRed')->first();
                @endphp
                @if($configRedReciente)
                    <div class="config-red-item">
                        <div class="field-group">
                            <label>Dirección MAC:</label>
                            <input type="text" 
                                   name="configRed[0][MAC]" 
                                   placeholder="Dirección MAC" 
                                   value="{{ old('configRed.0.MAC', $configRedReciente->MAC) }}">
                        </div>
                        <div class="field-group">
                            <label>Dirección IP:</label>
                            <input type="text" 
                                   name="configRed[0][IP]" 
                                   placeholder="Dirección IP" 
                                   value="{{ old('configRed.0.IP', $configRedReciente->IP) }}">
                        </div>
                    </div>
                @else
                    <div class="config-red-item">
                        <div class="field-group">
                            <label>Dirección MAC:</label>
                            <input type="text" name="configRed[0][MAC]" placeholder="Dirección MAC">
                        </div>
                        <div class="field-group">
                            <label>Dirección IP:</label>
                            <input type="text" name="configRed[0][IP]" placeholder="Dirección IP">
                        </div>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addConfigRed()" class="btn-add">+ Agregar Nueva Configuración de Red</button>
        </div>

        <div class="form-section">
            <h3>Hardware</h3>
            <div id="hardware-container">
                @php
                    $hardwareReciente = $equipo->hardware->sortByDesc('idHardware')->first();
                @endphp
                @if($hardwareReciente)
                    <div class="hardware-item">
                        <div class="field-group">
                            <label>Número de Placa:</label>
                            <input type="text" 
                                   name="hardware[0][NumeroPlaca]" 
                                   placeholder="Número de Placa" 
                                   value="{{ old('hardware.0.NumeroPlaca', $hardwareReciente->NumeroPlaca) }}">
                        </div>
                        <div class="field-group">
                            <label>Modelo CPU:</label>
                            <input type="text" 
                                   name="hardware[0][ModeloCPU]" 
                                   placeholder="Modelo CPU" 
                                   value="{{ old('hardware.0.ModeloCPU', $hardwareReciente->ModeloCPU) }}">
                        </div>
                        <div class="field-group">
                            <label>Serial CPU:</label>
                            <input type="text" 
                                   name="hardware[0][SerialCPU]" 
                                   placeholder="Serial CPU" 
                                   value="{{ old('hardware.0.SerialCPU', $hardwareReciente->SerialCPU) }}">
                        </div>
                        <div class="field-group">
                            <label>Procesador:</label>
                            <input type="text" 
                                   name="hardware[0][Procesador]" 
                                   placeholder="Procesador" 
                                   value="{{ old('hardware.0.Procesador', $hardwareReciente->Procesador) }}">
                        </div>
                        <div class="field-group">
                            <label>RAM:</label>
                            <input type="text" 
                                   name="hardware[0][RAM]" 
                                   placeholder="RAM" 
                                   value="{{ old('hardware.0.RAM', $hardwareReciente->RAM) }}">
                        </div>
                        <div class="field-group">
                            <label>Disco Duro:</label>
                            <input type="text" 
                                   name="hardware[0][HDD]" 
                                   placeholder="Disco Duro" 
                                   value="{{ old('hardware.0.HDD', $hardwareReciente->HDD) }}">
                        </div>
                        <div class="field-group">
                            <label>Monitor:</label>
                            <input type="text" 
                                   name="hardware[0][Monitor]" 
                                   placeholder="Monitor" 
                                   value="{{ old('hardware.0.Monitor', $hardwareReciente->Monitor) }}">
                        </div>
                        <div class="field-group">
                            <label>Serial Monitor:</label>
                            <input type="text" 
                                   name="hardware[0][SerialMonitor]" 
                                   placeholder="Serial Monitor" 
                                   value="{{ old('hardware.0.SerialMonitor', $hardwareReciente->SerialMonitor) }}">
                        </div>
                        <div class="field-group">
                            <label>Teclado:</label>
                            <input type="text" 
                                   name="hardware[0][Teclado]" 
                                   placeholder="Teclado" 
                                   value="{{ old('hardware.0.Teclado', $hardwareReciente->Teclado) }}">
                        </div>
                        <div class="field-group">
                            <label>Serial Teclado:</label>
                            <input type="text" 
                                   name="hardware[0][SerialTeclado]" 
                                   placeholder="Serial Teclado" 
                                   value="{{ old('hardware.0.SerialTeclado', $hardwareReciente->SerialTeclado) }}">
                        </div>
                        <div class="field-group">
                            <label>Mouse:</label>
                            <input type="text" 
                                   name="hardware[0][Mouse]" 
                                   placeholder="Mouse" 
                                   value="{{ old('hardware.0.Mouse', $hardwareReciente->Mouse) }}">
                        </div>
                        <div class="field-group">
                            <label>Serial Mouse:</label>
                            <input type="text" 
                                   name="hardware[0][SerialMouse]" 
                                   placeholder="Serial Mouse" 
                                   value="{{ old('hardware.0.SerialMouse', $hardwareReciente->SerialMouse) }}">
                        </div>
                    </div>
                @else
                    <div class="hardware-item">
                        <div class="field-group">
                            <label>Número de Placa:</label>
                            <input type="text" name="hardware[0][NumeroPlaca]" placeholder="Número de Placa">
                        </div>
                        <div class="field-group">
                            <label>Modelo CPU:</label>
                            <input type="text" name="hardware[0][ModeloCPU]" placeholder="Modelo CPU">
                        </div>
                        <div class="field-group">
                            <label>Serial CPU:</label>
                            <input type="text" name="hardware[0][SerialCPU]" placeholder="Serial CPU">
                        </div>
                        <div class="field-group">
                            <label>Procesador:</label>
                            <input type="text" name="hardware[0][Procesador]" placeholder="Procesador">
                        </div>
                        <div class="field-group">
                            <label>RAM:</label>
                            <input type="text" name="hardware[0][RAM]" placeholder="RAM">
                        </div>
                        <div class="field-group">
                            <label>Disco Duro:</label>
                            <input type="text" name="hardware[0][HDD]" placeholder="Disco Duro">
                        </div>
                        <div class="field-group">
                            <label>Monitor:</label>
                            <input type="text" name="hardware[0][Monitor]" placeholder="Monitor">
                        </div>
                        <div class="field-group">
                            <label>Serial Monitor:</label>
                            <input type="text" name="hardware[0][SerialMonitor]" placeholder="Serial Monitor">
                        </div>
                        <div class="field-group">
                            <label>Teclado:</label>
                            <input type="text" name="hardware[0][Teclado]" placeholder="Teclado">
                        </div>
                        <div class="field-group">
                            <label>Serial Teclado:</label>
                            <input type="text" name="hardware[0][SerialTeclado]" placeholder="Serial Teclado">
                        </div>
                        <div class="field-group">
                            <label>Mouse:</label>
                            <input type="text" name="hardware[0][Mouse]" placeholder="Mouse">
                        </div>
                        <div class="field-group">
                            <label>Serial Mouse:</label>
                            <input type="text" name="hardware[0][SerialMouse]" placeholder="Serial Mouse">
                        </div>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addHardware()" class="btn-add">+ Agregar Nueva Configuración de Hardware</button>
        </div>

        <div class="form-section">
            <h3>Software Instalado</h3>
            <div id="software-container">
                @php
                    $softwareReciente = $equipo->software_instalados->sortByDesc('idSoftwareInstalado')->first();
                @endphp
                @if($softwareReciente)
                    <div class="software-item">
                        <div class="field-group">
                            <label>Sistema Operativo:</label>
                            <input type="text" 
                                   name="software_instalados[0][SistemaOperativo]" 
                                   placeholder="Sistema Operativo" 
                                   value="{{ old('software_instalados.0.SistemaOperativo', $softwareReciente->SistemaOperativo) }}">
                        </div>
                        <div class="field-group">
                            <label>Suite Ofimática:</label>
                            <input type="text" 
                                   name="software_instalados[0][SuiteOfimatica]" 
                                   placeholder="Suite Ofimática" 
                                   value="{{ old('software_instalados.0.SuiteOfimatica', $softwareReciente->SuiteOfimatica) }}">
                        </div>
                        <div class="field-group">
                            <label>Licencia Suite Ofimática:</label>
                            <input type="text" 
                                   name="software_instalados[0][LicSuiteOfimatica]" 
                                   placeholder="Licencia Suite Ofimática" 
                                   value="{{ old('software_instalados.0.LicSuiteOfimatica', $softwareReciente->LicSuiteOfimatica) }}">
                        </div>
                        <div class="field-group">
                            <label>Antivirus:</label>
                            <input type="text" 
                                   name="software_instalados[0][Antivirus]" 
                                   placeholder="Antivirus" 
                                   value="{{ old('software_instalados.0.Antivirus', $softwareReciente->Antivirus) }}">
                        </div>
                        <div class="field-group">
                            <label>Licencia Antivirus:</label>
                            <input type="text" 
                                   name="software_instalados[0][LicAntivirus]" 
                                   placeholder="Licencia Antivirus" 
                                   value="{{ old('software_instalados.0.LicAntivirus', $softwareReciente->LicAntivirus) }}">
                        </div>
                    </div>
                @else
                    <div class="software-item">
                        <div class="field-group">
                            <label>Sistema Operativo:</label>
                            <input type="text" name="software_instalados[0][SistemaOperativo]" placeholder="Sistema Operativo">
                        </div>
                        <div class="field-group">
                            <label>Suite Ofimática:</label>
                            <input type="text" name="software_instalados[0][SuiteOfimatica]" placeholder="Suite Ofimática">
                        </div>
                        <div class="field-group">
                            <label>Licencia Suite Ofimática:</label>
                            <input type="text" name="software_instalados[0][LicSuiteOfimatica]" placeholder="Licencia Suite Ofimática">
                        </div>
                        <div class="field-group">
                            <label>Antivirus:</label>
                            <input type="text" name="software_instalados[0][Antivirus]" placeholder="Antivirus">
                        </div>
                        <div class="field-group">
                            <label>Licencia Antivirus:</label>
                            <input type="text" name="software_instalados[0][LicAntivirus]" placeholder="Licencia Antivirus">
                        </div>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addSoftware()" class="btn-add">+ Agregar Nueva Configuración de Software</button>
        </div>

        <div class="buttons-container">
            <button type="submit" class="btn-submit">Actualizar Equipo</button>
            <a href="{{ route('equipos.index') }}" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

<script>
let configRedCount = 1;
let hardwareCount = 1;
let softwareCount = 1;

function addConfigRed() {
    const container = document.getElementById('configRed-container');
    const lastItem = container.querySelector('.config-red-item:last-child');
    
    // Obtener valores del último formulario para copiarlos
    const lastMAC = lastItem ? lastItem.querySelector('input[name$="[MAC]"]').value : '';
    const lastIP = lastItem ? lastItem.querySelector('input[name$="[IP]"]').value : '';
    
    const newItem = document.createElement('div');
    newItem.className = 'config-red-item';
    newItem.innerHTML = `
        <div class="field-group">
            <label>Dirección MAC:</label>
            <input type="text" name="configRed[${configRedCount}][MAC]" placeholder="Dirección MAC" value="${lastMAC}">
        </div>
        <div class="field-group">
            <label>Dirección IP:</label>
            <input type="text" name="configRed[${configRedCount}][IP]" placeholder="Dirección IP" value="${lastIP}">
        </div>
    `;
    container.appendChild(newItem);
    configRedCount++;
}

function addHardware() {
    const container = document.getElementById('hardware-container');
    const lastItem = container.querySelector('.hardware-item:last-child');
    
    // Obtener valores del último formulario para copiarlos
    const values = {};
    if (lastItem) {
        const inputs = lastItem.querySelectorAll('input');
        inputs.forEach(input => {
            const fieldName = input.name.match(/\[(\w+)\]$/)[1];
            values[fieldName] = input.value;
        });
    }
    
    const newItem = document.createElement('div');
    newItem.className = 'hardware-item';
    newItem.innerHTML = `
        <div class="field-group">
            <label>Número de Placa:</label>
            <input type="text" name="hardware[${hardwareCount}][NumeroPlaca]" placeholder="Número de Placa" value="${values.NumeroPlaca || ''}">
        </div>
        <div class="field-group">
            <label>Modelo CPU:</label>
            <input type="text" name="hardware[${hardwareCount}][ModeloCPU]" placeholder="Modelo CPU" value="${values.ModeloCPU || ''}">
        </div>
        <div class="field-group">
            <label>Serial CPU:</label>
            <input type="text" name="hardware[${hardwareCount}][SerialCPU]" placeholder="Serial CPU" value="${values.SerialCPU || ''}">
        </div>
        <div class="field-group">
            <label>Procesador:</label>
            <input type="text" name="hardware[${hardwareCount}][Procesador]" placeholder="Procesador" value="${values.Procesador || ''}">
        </div>
        <div class="field-group">
            <label>RAM:</label>
            <input type="text" name="hardware[${hardwareCount}][RAM]" placeholder="RAM" value="${values.RAM || ''}">
        </div>
        <div class="field-group">
            <label>Disco Duro:</label>
            <input type="text" name="hardware[${hardwareCount}][HDD]" placeholder="Disco Duro" value="${values.HDD || ''}">
        </div>
        <div class="field-group">
            <label>Monitor:</label>
            <input type="text" name="hardware[${hardwareCount}][Monitor]" placeholder="Monitor" value="${values.Monitor || ''}">
        </div>
        <div class="field-group">
            <label>Serial Monitor:</label>
            <input type="text" name="hardware[${hardwareCount}][SerialMonitor]" placeholder="Serial Monitor" value="${values.SerialMonitor || ''}">
        </div>
        <div class="field-group">
            <label>Teclado:</label>
            <input type="text" name="hardware[${hardwareCount}][Teclado]" placeholder="Teclado" value="${values.Teclado || ''}">
        </div>
        <div class="field-group">
            <label>Serial Teclado:</label>
            <input type="text" name="hardware[${hardwareCount}][SerialTeclado]" placeholder="Serial Teclado" value="${values.SerialTeclado || ''}">
        </div>
        <div class="field-group">
            <label>Mouse:</label>
            <input type="text" name="hardware[${hardwareCount}][Mouse]" placeholder="Mouse" value="${values.Mouse || ''}">
        </div>
        <div class="field-group">
            <label>Serial Mouse:</label>
            <input type="text" name="hardware[${hardwareCount}][SerialMouse]" placeholder="Serial Mouse" value="${values.SerialMouse || ''}">
        </div>
    `;
    container.appendChild(newItem);
    hardwareCount++;
}

function addSoftware() {
    const container = document.getElementById('software-container');
    const lastItem = container.querySelector('.software-item:last-child');
    
    // Obtener valores del último formulario para copiarlos
    const values = {};
    if (lastItem) {
        const inputs = lastItem.querySelectorAll('input');
        inputs.forEach(input => {
            const fieldName = input.name.match(/\[(\w+)\]$/)[1];
            values[fieldName] = input.value;
        });
    }
    
    const newItem = document.createElement('div');
    newItem.className = 'software-item';
    newItem.innerHTML = `
        <div class="field-group">
            <label>Sistema Operativo:</label>
            <input type="text" name="software_instalados[${softwareCount}][SistemaOperativo]" placeholder="Sistema Operativo" value="${values.SistemaOperativo || ''}">
        </div>
        <div class="field-group">
            <label>Suite Ofimática:</label>
            <input type="text" name="software_instalados[${softwareCount}][SuiteOfimatica]" placeholder="Suite Ofimática" value="${values.SuiteOfimatica || ''}">
        </div>
        <div class="field-group">
            <label>Licencia Suite Ofimática:</label>
            <input type="text" name="software_instalados[${softwareCount}][LicSuiteOfimatica]" placeholder="Licencia Suite Ofimática" value="${values.LicSuiteOfimatica || ''}">
        </div>
        <div class="field-group">
            <label>Antivirus:</label>
            <input type="text" name="software_instalados[${softwareCount}][Antivirus]" placeholder="Antivirus" value="${values.Antivirus || ''}">
        </div>
        <div class="field-group">
            <label>Licencia Antivirus:</label>
            <input type="text" name="software_instalados[${softwareCount}][LicAntivirus]" placeholder="Licencia Antivirus" value="${values.LicAntivirus || ''}">
        </div>
    `;
    container.appendChild(newItem);
    softwareCount++;
}
</script>

<style>
.field-group {
    margin-bottom: 10px;
}

.field-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.config-red-item, .hardware-item, .software-item {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #f9f9f9;
}
</style>
@endsection