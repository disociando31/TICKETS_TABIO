@extends('layouts.app')

@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Crear Nuevo Ticket</h1>
    </div>

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="Tipo">Tipo de Ticket</label>
            <select name="Tipo" id="Tipo" class="@error('Tipo') is-invalid @enderror" required>
                <option value="">Seleccione un tipo</option>
                <option value="Soporte" {{ old('Tipo') == 'Soporte' ? 'selected' : '' }}>
                    <i class="fas fa-tools"></i> Soporte Técnico
                </option>
                <option value="Solicitud de servicio" {{ old('Tipo') == 'Solicitud de servicio' ? 'selected' : '' }}>
                    <i class="fas fa-file-alt"></i> Solicitud de Servicio
                </option>
            </select>
            @error('Tipo')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            <small class="form-text text-muted">
                Seleccione el tipo de ticket según su necesidad
            </small>
        </div>

        <div class="form-group">
            <label for="Descripcion">Descripción del Problema</label>
            <textarea 
                name="Descripcion" 
                id="Descripcion" 
                rows="10" 
                class="form-control @error('Descripcion') is-invalid @enderror" 
                required
                style="min-width: 100%; width: 100%;"
                placeholder="Describa detalladamente el problema o la solicitud..."
            >{{ old('Descripcion') }}</textarea>
            @error('Descripcion')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            <small class="form-text text-muted">
                Proporcione todos los detalles relevantes para ayudarnos a entender mejor su solicitud
            </small>
        </div>

        <div class="buttons-container">
            <button type="submit">
                <i class="fas fa-save"></i> CREAR TICKET
            </button>
            <a href="{{ route('tickets.index') }}">
                <i class="fas fa-times"></i> CANCELAR
            </a>
        </div>
    </form>
</div>
@endsection
