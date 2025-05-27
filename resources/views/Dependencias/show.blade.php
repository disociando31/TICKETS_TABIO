@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="detalles-usuario-container">
    <div class="header">
        <h1>Detalles de la Dependencia</h1>
    </div>

    <div class="detalles-content">
        <div class="info-card">
            <div class="info-section">
                <div class="detalle-item">
                    <label>ID:</label>
                    <div class="valor">{{ $dependencia->idDependencia }}</div>
                </div>

                <div class="detalle-item">
                    <label>Nombre:</label>
                    <div class="valor">{{ $dependencia->Dependencia }}</div>
                </div>

                <div class="detalle-item">
                    <label>Estado:</label>
                    <div class="valor">
                        <span class="estado-badge {{ $dependencia->Estado == 'A' ? 'activo' : 'inactivo' }}">
                            {{ $dependencia->Estado == 'A' ? 'Activo' : 'Inactivo' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="info-section">
                <div class="detalle-item">
                    <label>Usuarios Asignados:</label>
                    <div class="valor">
                        @if($dependencia->usuarios->count() > 0)
                            <ul class="usuarios-list">
                                @foreach($dependencia->usuarios as $usuario)
                                    <li>{{ $usuario->nombre }} ({{ $usuario->username }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="no-data">No hay usuarios asignados</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="actions-container">
        @can('gestionar_dependencias')
        <a href="{{ route('dependencias.edit', $dependencia->idDependencia) }}" class="btn-editar">
            <i class="fas fa-edit"></i> Editar Dependencia
        </a>
        @endcan
        <a href="{{ route('dependencias.index') }}" class="btn-volver">
            <i class="fas fa-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection