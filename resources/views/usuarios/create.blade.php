@extends('layouts.app')

@section('content')
<div class="users-container">
    <div class="container">
        <h1>Crear Nuevo Usuario</h1>
        
        @if ($errors->any())
            <div class="error-container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}">
            </div>
            
            <div class="form-group">
                <label for="idDependencia">Dependencia:</label>
                <select id="idDependencia" name="idDependencia" required>
                    <option value="">Seleccione una dependencia</option>
                    @foreach($dependencias as $dependencia)
                        <option value="{{ $dependencia->idDependencia }}" {{ old('idDependencia') == $dependencia->idDependencia ? 'selected' : '' }}>
                            {{ $dependencia->Dependencia }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="">Seleccione un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->name }}" {{ old('rol') == $rol->name ? 'selected' : '' }}>
                            {{ $rol->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="buttons-container">
                <button type="submit">Guardar Usuario</button>
                <a href="{{ route('usuarios.index') }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection