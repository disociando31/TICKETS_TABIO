@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Usuario</h1>
    
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: A10px;">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password_confirmation">Confirmar Contraseña:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="idDependencia">Dependencia:</label><br>
            <select id="idDependencia" name="idDependencia" required>
                <option value="">Seleccione una dependencia</option>
                @foreach($dependencias as $dependencia)
                    <option value="{{ $dependencia->idDependencia }}" {{ old('idDependencia') == $dependencia->idDependencia ? 'selected' : '' }}>
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
                    <option value="{{ $rol->name }}" {{ old('rol') == $rol->name ? 'selected' : '' }}>
                        {{ $rol->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit">Guardar Usuario</button>
            <a href="{{ route('usuarios.index') }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection