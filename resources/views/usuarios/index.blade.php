@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Usuarios</h1>
    
    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div style="color: red; margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif
    
    <div style="margin-bottom: 20px;">
        <a href="{{ route('usuarios.create') }}">Crear Nuevo Usuario</a>
    </div>
    
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Username</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->idUsuario }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->username }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td>{{ $usuario->getRoleNames()->first() }}</td>
                <td>
                    <a href="{{ route('usuarios.show', $usuario->idUsuario) }}">Ver</a> |
                    <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}">Editar</a> |
                    
                    <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;" 
                                onclick="return confirm('¿Estás seguro de querer eliminar este usuario?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $usuarios->links() }}
    </div>
    
    <div style="margin-top: 20px;">
        <a href="{{ route('home') }}">Volver al Dashboard</a>
    </div>
</div>
@endsection