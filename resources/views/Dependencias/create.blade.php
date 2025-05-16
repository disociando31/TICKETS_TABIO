@extends('layouts.app')
@section('content')
@include('partials.accessibility')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Crear Nueva Dependencia</h1>
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

    <form method="POST" action="{{ route('dependencias.store') }}">
        @csrf
        <div class="form-group">
            <label for="Dependencia">Nombre de la Dependencia:</label>
            <input type="text" id="Dependencia" name="Dependencia" value="{{ old('Dependencia') }}" required>
        </div>

        <div class="buttons-container">
            <button type="submit">Guardar Dependencia</button>
            <a href="{{ route('dependencias.index') }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection