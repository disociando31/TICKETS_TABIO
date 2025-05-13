@extends('layouts.app')
@section('content')
@include('partials.accessibility')
<div class="perfil-container">
    <div class="header">
        <h1>Mi Perfil</h1>
        <p class="subtitle">Gestiona tu información personal</p>
    </div>
    
    @if (session('success'))
        <div class="success-container">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    @if ($errors->any())
        <div class="error-container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="profile-content">
        <form action="{{ route('perfil.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-section">
                <h2>Información Personal</h2>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">
                </div>
            </div>

            <div class="form-section">
                <h2>Cambiar Contraseña</h2>
                <div class="form-group">
                    <label for="password_actual">Contraseña Actual:</label>
                    <input type="password" id="password_actual" name="password_actual">
                    <small>Requerida para cambiar la contraseña</small>
                </div>
                
                <div class="form-group">
                    <label for="password">Nueva Contraseña:</label>
                    <input type="password" id="password" name="password">
                    <small>Dejar en blanco si no desea cambiar la contraseña</small>
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            
            <div class="buttons-container">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Actualizar Perfil
                </button>
                <a href="{{ route('home') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection