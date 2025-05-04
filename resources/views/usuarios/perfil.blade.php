@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi Perfil</h1>
    
    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('perfil.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 10px;">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password_actual">Contraseña Actual (requerida para cambiar contraseña):</label><br>
            <input type="password" id="password_actual" name="password_actual">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password">Nueva Contraseña (dejar en blanco para no cambiar):</label><br>
            <input type="password" id="password" name="password">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="password_confirmation">Confirmar Nueva Contraseña:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit">Actualizar Perfil</button>
            <a href="{{ route('home') }}">Volver al Dashboard</a>
        </div>
    </form>
</div>
@endsection