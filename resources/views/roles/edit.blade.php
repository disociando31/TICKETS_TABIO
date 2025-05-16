@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Rol</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Editar Rol</h1>
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

    <form method="POST" action="{{ route('roles.update', $rol->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nombre del Rol:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $rol->name) }}" required>
        </div>

        <div class="permisos-section">
            <div class="permisos-header">
                <h3>Permisos Disponibles</h3>
                <p>Selecciona los permisos que deseas asignar a este rol</p>
            </div>
            
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
                                   value="{{ $permiso->name }}"
                                   {{ in_array($permiso->name, $rolPermisos) ? 'checked' : '' }}>
                            <label for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="buttons-container">
            <button type="submit">Actualizar Rol</button>
            <a href="{{ route('roles.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@section('accessibility')
    @include('partials.accessibility')
@endsection
