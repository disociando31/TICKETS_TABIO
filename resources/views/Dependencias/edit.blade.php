@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Editar Dependencia</h1>
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

    <form method="POST" action="{{ route('dependencias.update', $dependencia->idDependencia) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="Dependencia">Nombre de la Dependencia:</label>
            <input type="text" id="Dependencia" name="Dependencia" value="{{ old('Dependencia', $dependencia->Dependencia) }}" required>
        </div>

        <div class="form-group">
            <label for="Estado">Estado:</label>
            <select id="Estado" name="Estado" required>
                <option value="A" {{ old('Estado', $dependencia->Estado) == 'A' ? 'selected' : '' }}>Activo</option>
                <option value="I" {{ old('Estado', $dependencia->Estado) == 'I' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        
        <div class="buttons-container">
            <button type="submit">Actualizar Dependencia</button>
            <a href="{{ route('dependencias.index') }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection