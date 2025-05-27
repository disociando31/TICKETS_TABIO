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

        <div class="hardware-section">
            <h3>Componentes de Hardware</h3>
            @if($equipo->hardware->isEmpty())
                <p class="no-data">No hay componentes de hardware registrados.</p>
            @else
                <div class="hardware-list">
                    @foreach($equipo->hardware as $hw)
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
            @endif
        </div>
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