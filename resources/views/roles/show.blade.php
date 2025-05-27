@extends('layouts.app')

@section('content')
@include('partials.accessibility')
<div class="perfil-container">
    <div class="header">
        <h1>Detalles del Rol</h1>
        <p class="subtitle">Información detallada del rol y sus permisos</p>
    </div>
    
    <div class="profile-content">
        <div class="form-section">
            <h2>Información del Rol</h2>
            <div class="form-group">
                <label>ID:</label>
                <div class="valor">{{ $rol->id }}</div>
            </div>
            <div class="form-group">
                <label>Nombre:</label>
                <div class="valor">{{ $rol->name }}</div>
            </div>
            <div class="form-group">
                <label>Estado:</label>
                <div class="valor">
                    <span class="estado-badge {{ $rol->estado ? 'estado-activo' : 'estado-inactivo' }}">
                        {{ $rol->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h2>Permisos Asignados</h2>
            <div class="permisos-container">
                @foreach($permisos as $permiso)
                    <span class="permiso-badge">{{ $permiso->name }}</span>
                @endforeach
            </div>
        </div>
        
        <div class="buttons-container">
            @can('gestionar_roles')
                {{-- Botón de editar removido ya que la funcionalidad está deshabilitada --}}
                <form action="{{ route('roles.toggle-estado', $rol->id) }}" method="POST" class="form-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="btn-secondary"
                            onclick="return confirm(`¿Está seguro de ${this.innerHTML.includes('Desactivar') ? 'desactivar' : 'activar'} este rol?`)">
                        <i class="fas fa-power-off"></i> {{ $rol->estado ? 'Desactivar' : 'Activar' }}
                    </button>
                </form>
            @endcan
            <a href="{{ route('roles.index') }}" class="btn-primary">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@endsection