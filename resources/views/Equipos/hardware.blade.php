@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Hardware - {{ $equipo->NombreEquipo }}</h1>
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
        <div class="hardware-section">
            <h3>Configuración Actual</h3>
            @if($hardwareActual)
                <div class="hardware-list">
                    <div class="hardware-item">
                        <div class="detalle-item">
                            <label>Número de Placa:</label>
                            <span class="valor">{{ $hardwareActual->NumeroPlaca }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Modelo CPU:</label>
                            <span class="valor">{{ $hardwareActual->ModeloCPU }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial CPU:</label>
                            <span class="valor">{{ $hardwareActual->SerialCPU }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Procesador:</label>
                            <span class="valor">{{ $hardwareActual->Procesador }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>RAM:</label>
                            <span class="valor">{{ $hardwareActual->RAM }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>HDD:</label>
                            <span class="valor">{{ $hardwareActual->HDD }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Monitor:</label>
                            <span class="valor">{{ $hardwareActual->Monitor }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial Monitor:</label>
                            <span class="valor">{{ $hardwareActual->SerialMonitor }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Teclado:</label>
                            <span class="valor">{{ $hardwareActual->Teclado }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial Teclado:</label>
                            <span class="valor">{{ $hardwareActual->SerialTeclado }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Mouse:</label>
                            <span class="valor">{{ $hardwareActual->Mouse }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial Mouse:</label>
                            <span class="valor">{{ $hardwareActual->SerialMouse }}</span>
                        </div>
                    </div>
                </div>
            @else
                <p class="no-data">No hay configuración de hardware actual registrada.</p>
            @endif
        </div>

        <!-- Historial de Configuraciones -->
        @if($historialHardware->isNotEmpty())
        <div class="hardware-section">
            <h3>Historial de Configuraciones</h3>
            <div class="hardware-list">
                @foreach($historialHardware as $hw)
                    <div class="hardware-item">
                        <div class="detalle-item">
                            <label>Número de Placa:</label>
                            <span class="valor">{{ $hw->NumeroPlaca }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Modelo CPU:</label>
                            <span class="valor">{{ $hw->ModeloCPU }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial CPU:</label>
                            <span class="valor">{{ $hw->SerialCPU }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Procesador:</label>
                            <span class="valor">{{ $hw->Procesador }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>RAM:</label>
                            <span class="valor">{{ $hw->RAM }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>HDD:</label>
                            <span class="valor">{{ $hw->HDD }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Monitor:</label>
                            <span class="valor">{{ $hw->Monitor }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial Monitor:</label>
                            <span class="valor">{{ $hw->SerialMonitor }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Teclado:</label>
                            <span class="valor">{{ $hw->Teclado }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial Teclado:</label>
                            <span class="valor">{{ $hw->SerialTeclado }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Mouse:</label>
                            <span class="valor">{{ $hw->Mouse }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Serial Mouse:</label>
                            <span class="valor">{{ $hw->SerialMouse }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.hardware-item {
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