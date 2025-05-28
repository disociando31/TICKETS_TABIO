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
                        <div><strong>Número de Placa:</strong> {{ $hw->NumeroPlaca ?? 'No especificado' }}</div>
                        <div><strong>Modelo CPU:</strong> {{ $hw->ModeloCPU ?? 'No especificado' }}</div>
                        <div><strong>Serial CPU:</strong> {{ $hw->SerialCPU ?? 'No especificado' }}</div>
                        <div><strong>Procesador:</strong> {{ $hw->Procesador ?? 'No especificado' }}</div>
                        <div><strong>RAM:</strong> {{ $hw->RAM ?? 'No especificado' }}</div>
                        <div><strong>HDD:</strong> {{ $hw->HDD ?? 'No especificado' }}</div>
                        <div><strong>Monitor:</strong> {{ $hw->Monitor ?? 'No especificado' }}</div>
                        <div><strong>Serial Monitor:</strong> {{ $hw->SerialMonitor ?? 'No especificado' }}</div>
                        <div><strong>Teclado:</strong> {{ $hw->Teclado ?? 'No especificado' }}</div>
                        <div><strong>Serial Teclado:</strong> {{ $hw->SerialTeclado ?? 'No especificado' }}</div>
                        <div><strong>Mouse:</strong> {{ $hw->Mouse ?? 'No especificado' }}</div>
                        <div><strong>Serial Mouse:</strong> {{ $hw->SerialMouse ?? 'No especificado' }}</div>
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
                        <div><strong>Sistema Operativo:</strong> {{ $sw->SistemaOperativo ?? 'No especificado' }}</div>
                        <div><strong>Suite Ofimática:</strong> {{ $sw->SuiteOfimatica ?? 'No especificado' }}</div>
                        <div><strong>Licencia Suite Ofimática:</strong> {{ $sw->LicSuiteOfimatica ?? 'No especificado' }}</div>
                        <div><strong>Antivirus:</strong> {{ $sw->Antivirus ?? 'No especificado' }}</div>
                        <div><strong>Licencia Antivirus:</strong> {{ $sw->LicAntivirus ?? 'No especificado' }}</div>
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