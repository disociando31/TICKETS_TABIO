@extends('layouts.app')
@section('content')
@include('partials.accessibility')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Crear Nuevo Rol</h1>
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

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Rol:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="permisos-section">
            <div class="permisos-header">
                <h3>Permisos Disponibles</h3>
                <p>Selecciona los permisos que deseas asignar a este rol</p>
            </div>
            
            <!-- Permisos Generales -->
            <div class="permisos-group">
                <div class="permisos-group-header">
                    <h4>Permisos Generales</h4>
                </div>
                <div class="permisos-items">
                    @foreach($permisos as $permiso)
                        <div class="permiso-item">
                            <input type="checkbox" 
                                   id="permiso_{{ $permiso->id }}" 
                                   name="permisos[]" 
                                   value="{{ $permiso->id }}"
                                   {{ in_array($permiso->id, old('permisos', [])) ? 'checked' : '' }}>
                            <label for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="buttons-container">
            <button type="submit">Guardar Rol</button>
            <a href="{{ route('roles.index') }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection

