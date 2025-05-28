@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Registrar Nuevo Equipo</h1>
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

    <form method="POST" action="{{ route('equipos.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="NombreEquipo">Nombre del Equipo:</label>
            <input type="text" 
                   id="NombreEquipo" 
                   name="NombreEquipo" 
                   value="{{ old('NombreEquipo') }}" 
                   required>
        </div>

        <div class="form-group">
            <label for="idDependencia">Dependencia:</label>
            <select id="idDependencia" 
                    name="idDependencia" 
                    required>
                <option value="">Seleccione una dependencia</option>
                @foreach($dependencias as $dependencia)
                    <option value="{{ $dependencia->idDependencia }}" {{ old('idDependencia') == $dependencia->idDependencia ? 'selected' : '' }}>
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
                   value="{{ old('FechaAdquisicion') }}"
                   required
                   oninvalid="this.setCustomValidity('La fecha de adquisición es obligatoria')"
                   oninput="this.setCustomValidity('')">
        </div>

        <div class="form-section">
            <h3>Configuración de Red</h3>
            <div class="config-red-item">
                <input type="text" name="configRed[0][MAC]" placeholder="Dirección MAC" value="{{ old('configRed.0.MAC') }}">
                <input type="text" name="configRed[0][IP]" placeholder="Dirección IP" value="{{ old('configRed.0.IP') }}">
            </div>
        </div>

        <div class="form-section">
            <h3>Hardware</h3>
            <div class="hardware-item">
                <input type="text" 
                       name="hardware[0][NumeroPlaca]" 
                       placeholder="Número de Placa" 
                       value="{{ old('hardware.0.NumeroPlaca') }}">
                <input type="text" 
                       name="hardware[0][ModeloCPU]" 
                       placeholder="Modelo CPU" 
                       value="{{ old('hardware.0.ModeloCPU') }}">
                <input type="text" 
                       name="hardware[0][SerialCPU]" 
                       placeholder="Serial CPU" 
                       value="{{ old('hardware.0.SerialCPU') }}">
                <input type="text" 
                       name="hardware[0][Procesador]" 
                       placeholder="Procesador" 
                       value="{{ old('hardware.0.Procesador') }}">
                <input type="text" 
                       name="hardware[0][RAM]" 
                       placeholder="RAM" 
                       value="{{ old('hardware.0.RAM') }}">
                <input type="text" 
                       name="hardware[0][HDD]" 
                       placeholder="Disco Duro" 
                       value="{{ old('hardware.0.HDD') }}">
                <input type="text" 
                       name="hardware[0][Monitor]" 
                       placeholder="Monitor" 
                       value="{{ old('hardware.0.Monitor') }}">
                <input type="text" 
                       name="hardware[0][SerialMonitor]" 
                       placeholder="Serial Monitor" 
                       value="{{ old('hardware.0.SerialMonitor') }}">
                <input type="text" 
                       name="hardware[0][Teclado]" 
                       placeholder="Teclado" 
                       value="{{ old('hardware.0.Teclado') }}">
                <input type="text" 
                       name="hardware[0][SerialTeclado]" 
                       placeholder="Serial Teclado" 
                       value="{{ old('hardware.0.SerialTeclado') }}">
                <input type="text" 
                       name="hardware[0][Mouse]" 
                       placeholder="Mouse" 
                       value="{{ old('hardware.0.Mouse') }}">
                <input type="text" 
                       name="hardware[0][SerialMouse]" 
                       placeholder="Serial Mouse" 
                       value="{{ old('hardware.0.SerialMouse') }}">
            </div>
        </div>

        <div class="form-section">
            <h3>Software Instalado</h3>
            <div class="software-item">
                <input type="text" 
                       name="software_instalados[0][SistemaOperativo]" 
                       placeholder="Sistema Operativo" 
                       value="{{ old('software_instalados.0.SistemaOperativo') }}">
                <input type="text" 
                       name="software_instalados[0][LicSuiteOfimatica]" 
                       placeholder="Licencia Suite Ofimática" 
                       value="{{ old('software_instalados.0.LicSuiteOfimatica') }}">
                <input type="text" 
                       name="software_instalados[0][SuiteOfimatica]" 
                       placeholder="Suite Ofimática" 
                       value="{{ old('software_instalados.0.SuiteOfimatica') }}">
                <input type="text" 
                       name="software_instalados[0][LicAntivirus]" 
                       placeholder="Licencia Antivirus" 
                       value="{{ old('software_instalados.0.LicAntivirus') }}">
                <input type="text" 
                       name="software_instalados[0][Antivirus]" 
                       placeholder="Antivirus" 
                       value="{{ old('software_instalados.0.Antivirus') }}">
            </div>
        </div>

        <div class="buttons-container">
            <button type="submit" class="btn-submit">Registrar Equipo</button>
            <a href="{{ route('equipos.index') }}" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

<style>
.form-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.config-red-item,
.hardware-item,
.software-item {
    background: white;
    padding: 1.5rem;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-bottom: 1rem;
    display: grid;
    gap: 1rem;
}

.config-red-item {
    grid-template-columns: repeat(2, 1fr);
}

.hardware-item {
    grid-template-columns: repeat(4, 1fr);
    @media (max-width: 1024px) {
        grid-template-columns: repeat(3, 1fr);
    }
    @media (max-width: 768px) {
        grid-template-columns: repeat(2, 1fr);
    }
}

.software-item {
    grid-template-columns: repeat(3, 1fr);
    @media (max-width: 768px) {
        grid-template-columns: repeat(2, 1fr);
    }
}

.buttons-container {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
}

.btn-submit,
.btn-cancel {
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
}

.btn-submit {
    background: #007bff;
    color: white;
    border: none;
}

.btn-cancel {
    background: #6c757d;
    color: white;
    border: none;
}
</style>
@endsection