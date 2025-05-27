@extends('layouts.app')

@section('content')
<div class="detalles-usuario-container">
    <div class="header">
        <h1>Detalles del Equipo</h1>
    </div>

    <div class="detalles-content">
        <div class="info-card">
            <div class="info-section">
                <div class="detalle-item">
                    <label>ID:</label>
                    <div class="valor">{{ $equipo->idEquipo }}</div>
                </div>

                <div class="detalle-item">
                    <label>Nombre del Equipo:</label>
                    <div class="valor">{{ $equipo->NombreEquipo }}</div>
                </div>

                <div class="detalle-item">
                    <label>Dependencia:</label>
                    <div class="valor">{{ $equipo->dependencia->Dependencia ?? 'No asignada' }}</div>
                </div>

                <div class="detalle-item">
                    <label>Fecha de Adquisición:</label>
                    <div class="valor">{{ $equipo->FechaAdquisicion ? date('d/m/Y', strtotime($equipo->FechaAdquisicion)) : 'No especificada' }}</div>
                </div>
            </div>

            @if($equipo->configRed && $equipo->configRed->count() > 0)
            <div class="info-section">
                <div class="detalle-item">
                    <label>Configuración de Red</label>
                    @foreach($equipo->configRed as $config)
                    <div class="valor">
                        <div>MAC: {{ $config->MAC }}</div>
                        <div>IP: {{ $config->IP }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        @if($equipo->hardware && $equipo->hardware->count() > 0)
        <div class="info-card">
            <div class="info-section">
                <div class="detalle-item">
                    <label>Hardware</label>
                    @foreach($equipo->hardware as $hw)
                    <div class="valor">
                        <div>Número de Placa: {{ $hw->NumeroPlaca }}</div>
                        <div>Modelo CPU: {{ $hw->ModeloCPU }}</div>
                        <div>Serial CPU: {{ $hw->SerialCPU }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($equipo->software_instalados && $equipo->software_instalados->count() > 0)
        <div class="info-card">
            <div class="info-section">
                <div class="detalle-item">
                    <label>Software Instalado</label>
                    @foreach($equipo->software_instalados as $sw)
                    <div class="valor">
                        <div>{{ $sw->Nombre }} - Versión: {{ $sw->Version }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="actions-container">
        <a href="{{ route('equipos.edit', $equipo->idEquipo) }}" class="btn-editar">
            <i class="fas fa-edit"></i> Editar Equipo
        </a>
        <a href="{{ route('equipos.index') }}" class="btn-volver">
            <i class="fas fa-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection