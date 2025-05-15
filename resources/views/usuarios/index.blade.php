@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Listado de Usuarios</span>
                        @can('gestionar_usuarios')
                            <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm">Crear Usuario</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulario de búsqueda y filtros -->
                    <form action="{{ route('usuarios.index') }}" method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o username" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="role" class="form-select">
                                    <option value="">Todos los roles</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="dependencia" class="form-select">
                                    <option value="">Todas las dependencias</option>
                                    @foreach($dependencias as $dependencia)
                                        <option value="{{ $dependencia->idDependencia }}" {{ request('dependencia') == $dependencia->idDependencia ? 'selected' : '' }}>
                                            {{ $dependencia->Dependencia }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Tabla de usuarios -->
                    <div class="table-responsive">
                        <table class="table">
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
                                            <span class="badge bg-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('usuarios.show', $usuario->idUsuario) }}" class="btn btn-info btn-sm">Ver</a>
                                        
                                        @can('gestionar_usuarios')
                                        <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn btn-warning btn-sm">Editar</a>
                                        
                                        <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</button>
                                        </form>
                                        @endcan
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
            </div>
        </div>
=======
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1>Listado de Usuarios</h1>
        @can('gestionar_usuarios')
            <a href="{{ route('usuarios.create') }}" class="btn-crear-usuario">Crear Usuario</a>
        @endcan
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
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
                <td class="usuario-actions">
                    <a href="{{ route('usuarios.show', $usuario->idUsuario) }}" class="btn-editar">Ver</a>
                    
                    @can('gestionar_usuarios')
                    <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn-editar">Editar</a>
                    
                    <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar" onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $usuarios->links() }}
>>>>>>> 4f26de5720d67de7fad2d4e0a322d490df30bd14
    </div>
</div>
@endsection