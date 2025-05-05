@extends('layouts.app')

@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1 class="usuarios-title">Listado de Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="btn-crear">+ Crear Usuario</a>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="table-container">
        <table class="usuarios-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th>Dependencia</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->username }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>{{ $usuario->dependencia->nombre }}</td>
                    <td>
                        <span class="usuario-estado {{ $usuario->estado ? 'activo' : 'inactivo' }}">
                            {{ $usuario->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="acciones">
                        <button class="btn-editar">Editar</button>
                        <button class="btn-eliminar">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="pagination">
        {{ $usuarios->links() }}
    </div>
</div>
@endsection