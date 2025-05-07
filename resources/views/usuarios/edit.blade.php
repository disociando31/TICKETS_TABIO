@extends('layouts.app')
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 10px;">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username', $usuario->username) }}" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password">Contraseña (dejar en blanco para no cambiar):</label><br>
            <input type="password" id="password" name="password">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password_confirmation">Confirmar Contraseña:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="idDependencia">Dependencia:</label><br>
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
        
        <div style="margin-bottom: 10px;">
            <label for="rol">Rol:</label><br>
            <select id="rol" name="rol" required>
                <option value="">Seleccione un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->name }}" 
                        {{ in_array($rol->name, $userRoles) ? 'selected' : '' }}>
                        {{ $rol->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit">Actualizar Usuario</button>
            <a href="{{ route('usuarios.index') }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection