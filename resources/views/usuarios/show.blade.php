@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>
    
    <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 15px;">
        <p><strong>ID:</strong> {{ $usuario->idUsuario }}</p>
        <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
        <p><strong>Username:</strong> {{ $usuario->username }}</p>
        <p><strong>Teléfono:</strong> {{ $usuario->telefono ?? 'No especificado' }}</p>
        <p><strong>Dependencia:</strong> {{ $usuario->dependencia->Dependencia ?? 'No especificada' }}</p>
        <p><strong>Rol:</strong> {{ $usuario->getRoleNames()->first() ?? 'Sin rol asignado' }}</p>
        {{ var_dump($usuario->dependencia->Dependencia) }}
    </div>
    
    <div>
        <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}">Editar</a> |
        <a href="{{ route('usuarios.index') }}">Volver al listado</a>
    </div>
</div>
@endsection