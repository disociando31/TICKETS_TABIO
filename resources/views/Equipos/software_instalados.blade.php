@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Software Instalado - {{ $equipo->NombreEquipo }}</h1>
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

    <div class="info-card">
        <div class="info-section">
            <h3>Información del Equipo</h3>
            <div class="detalle-item">
                <label>Nombre del Equipo:</label>
                <span class="valor">{{ $equipo->NombreEquipo }}</span>
            </div>
            <div class="detalle-item">
                <label>Dependencia:</label>
                <span class="valor">{{ $equipo->dependencia->Dependencia }}</span>
            </div>
        </div>

        <!-- Configuración Actual -->
        <div class="software-section">
            <h3>Configuración Actual</h3>
            @if($softwareActual)
                <div class="software-list">
                    <div class="software-item">
                        <div class="detalle-item">
                            <label>Sistema Operativo:</label>
                            <span class="valor">{{ $softwareActual->SistemaOperativo ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Suite Ofimática:</label>
                            <span class="valor">{{ $softwareActual->SuiteOfimatica ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Licencia Suite Ofimática:</label>
                            <span class="valor">{{ $softwareActual->LicSuiteOfimatica ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Antivirus:</label>
                            <span class="valor">{{ $softwareActual->Antivirus ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Licencia Antivirus:</label>
                            <span class="valor">{{ $softwareActual->LicAntivirus ?? 'No especificado' }}</span>
                        </div>
                    </div>
                </div>
            @else
                <p class="no-data">No hay configuración de software actual registrada.</p>
            @endif
        </div>

        <!-- Historial de Configuraciones -->
        @if($historialSoftware->isNotEmpty())
        <div class="software-section">
            <h3>Historial de Configuraciones</h3>
            <div class="software-list">
                @foreach($historialSoftware as $software)
                    <div class="software-item">
                        <div class="detalle-item">
                            <label>Sistema Operativo:</label>
                            <span class="valor">{{ $software->SistemaOperativo ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Suite Ofimática:</label>
                            <span class="valor">{{ $software->SuiteOfimatica ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Licencia Suite Ofimática:</label>
                            <span class="valor">{{ $software->LicSuiteOfimatica ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Antivirus:</label>
                            <span class="valor">{{ $software->Antivirus ?? 'No especificado' }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Licencia Antivirus:</label>
                            <span class="valor">{{ $software->LicAntivirus ?? 'No especificado' }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.software-item {
    background: #f8f9fa;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.detalle-item {
    margin-bottom: 0.5rem;
}

.detalle-item label {
    font-weight: bold;
    margin-right: 0.5rem;
}
</style>
@endsection