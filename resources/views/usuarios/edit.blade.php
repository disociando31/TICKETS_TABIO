@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Editar Usuario</h1>
    </div>
    
    @if ($errors->any())
        <div class="error-container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('usuarios.update', $usuario->idUsuario) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username', $usuario->username) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
            <small>Dejar en blanco para mantener la contraseña actual</small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">
        </div>

        <div class="form-group">
            <label for="idDependencia">Dependencia:</label>
            <select id="idDependencia" name="idDependencia" required>
                <option value="">Seleccione una dependencia</option>
                @foreach($dependencias as $dependencia)
                    <option value="{{ $dependencia->idDependencia }}"
                        {{ old('idDependencia', $usuario->idDependencia) == $dependencia->idDependencia ? 'selected' : '' }}>
                        {{ $dependencia->Dependencia }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select id="rol" name="rol">
                <option value="">Desactivado</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->name }}"
                        {{ old('rol', $usuario->roles->first()->name ?? '') == $rol->name ? 'selected' : '' }}>
                        {{ $rol->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="buttons-container">
            <button type="submit">Actualizar Usuario</button>
            <a href="{{ route('usuarios.index') }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection