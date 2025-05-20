@extends('layouts.app')

y@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1 class="usuarios-title">Listado de Usuarios</h1>
        @can('gestionar_usuarios')
            <a href="{{ route('usuarios.create') }}" class="btn-crear">Crear Usuario</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario de búsqueda y filtros -->
    <div class="usuarios-filters">
        <form action="{{ route('usuarios.index') }}" method="GET" class="search-form">
            <div class="search-container">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar por nombre o username"
                    value="{{ request('search') }}"
                    class="search-input"
                >
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div class="filter-group">
                <select name="role" class="filter-dropdown">
                    <option value="">Todos los roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                
                <select name="dependencia" class="filter-dropdown">
                    <option value="">Todas las dependencias</option>
                    @foreach($dependencias as $dependencia)
                        <option value="{{ $dependencia->idDependencia }}" {{ request('dependencia') == $dependencia->idDependencia ? 'selected' : '' }}>
                            {{ $dependencia->Dependencia }}
                        </option>
                    @endforeach
                </select>
                
                <button type="submit" class="btn-filtrar">Filtrar</button>
            </div>
        </form>
    </div>

    <!-- Tabla de usuarios -->
    <div class="table-responsive">
        <table class="usuarios-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Dependencia</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->idUsuario }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->username }}</td>
                    <td>{{ $usuario->dependencia->Dependencia ?? 'N/A' }}</td>
                    <td>
                        @foreach($usuario->roles as $role)
                            <span class="badge-role">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="acciones-grupo">
                            <a href="{{ route('usuarios.show', $usuario->idUsuario) }}" class="btn-ver">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            
                            @can('gestionar_usuarios')
                            <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn-editar">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            
                            <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar" onclick="return confirm('¿Está seguro de eliminar este usuario?')">
                                    <i class="fas fa-trash"></i> Eliminar
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
    
    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $usuarios->links() }}
    </div>
</div>
@endsection