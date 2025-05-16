@extends('layouts.app')

@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1>Listado de Roles</h1>
        @can('gestionar_roles')
            <a href="{{ route('roles.create') }}" class="btn-crear-usuario">Crear Nuevo Rol</a>
        @endcan
    </div>
    
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $rol)
                    <tr>
                        <td>{{ $rol->id }}</td>
                        <td>{{ $rol->name }}</td>
                        <td>
                            <span class="estado-badge {{ $rol->estado ? 'estado-activo' : 'estado-inactivo' }}">
                                {{ $rol->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="permisos-cell">
                            <div class="permisos-container">
                                @foreach($rol->permissions as $permiso)
                                    <span class="permiso-badge">{{ $permiso->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="acciones-cell">
                            <div class="acciones-grupo">
                                <a href="{{ route('roles.show', $rol->id) }}" 
                                   class="btn-ver">
                                    Ver
                                </a>
                                @can('gestionar_roles')
                                    <a href="{{ route('roles.edit', $rol->id) }}" 
                                       class="btn-editar">
                                        Editar
                                    </a>
                                    <form action="{{ route('roles.toggle-estado', $rol->id) }}" 
                                          method="POST" 
                                          class="form-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn-estado {{ $rol->estado ? 'btn-desactivar' : 'btn-activar' }}"
                                                onclick="return confirm('¿Está seguro de {{ $rol->estado ? 'desactivar' : 'activar' }} este rol?')">
                                            {{ $rol->estado ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
.permisos-container {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    max-width: 300px;
}

.permiso-badge {
    background-color: #e3f2fd;
    color: #1565c0;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85rem;
    white-space: nowrap;
}

.btn-estado {
    padding: 6px 12px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-desactivar {
    background-color: #ef5350;
    color: white;
}

.btn-activar {
    background-color: #66bb6a;
    color: white;
}

.estado-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.estado-activo {
    background-color: #66bb6a;
    color: white;
}

.estado-inactivo {
    background-color: #ef5350;
    color: white;
}

.acciones-grupo {
    display: flex;
    gap: 8px;
    align-items: center;
}

.btn-ver, .btn-editar {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: white;
}

.btn-ver {
    background-color: #42a5f5;
}

.btn-editar {
    background-color: #ffa726;
}
</style>
@endsection