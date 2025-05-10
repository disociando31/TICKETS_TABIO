@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="detalles-usuario-container">
    <div class="header">
        <h1>Detalles del Usuario</h1>
    </div>

    <div class="detalles-content">
        <div class="info-card">
            <div class="info-section">
                <div class="detalle-item">
                    <label>ID:</label>
                    <div class="valor">{{ $usuario->idUsuario }}</div>
                </div>

                <div class="detalle-item">
                    <label>Nombre:</label>
                    <div class="valor">{{ $usuario->nombre }}</div>
                </div>

                <div class="detalle-item">
                    <label>Username:</label>
                    <div class="valor">{{ $usuario->username }}</div>
                </div>
            </div>

            <div class="info-section">
                <div class="detalle-item">
                    <label>Teléfono:</label>
                    <div class="valor">{{ $usuario->telefono ?? 'No especificado' }}</div>
                </div>

                <div class="detalle-item">
                    <label>Dependencia:</label>
                    <div class="valor">{{ $usuario->dependencia->Dependencia ?? 'No especificada' }}</div>
                </div>

                <div class="detalle-item">
                    <label>Rol:</label>
                    <div class="valor">
                        @foreach($usuario->roles as $rol)
                            <span class="rol-badge">{{ $rol->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="actions-container">
        @can('gestionar_usuarios')
        <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn-editar">
            <i class="fas fa-edit"></i> Editar Usuario
        </a>
        @endcan
        <a href="{{ route('usuarios.index') }}" class="btn-volver">
            <i class="fas fa-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection