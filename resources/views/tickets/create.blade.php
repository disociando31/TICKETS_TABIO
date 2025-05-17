@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Crear Nuevo Ticket</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Información del Ticket</div>
        <div class="card-body">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                
                <div class="form-group row mb-3">
                    <label for="Tipo" class="col-md-3 col-form-label">Tipo de Ticket</label>
                    <div class="col-md-9">
                        <select name="Tipo" id="Tipo" class="form-control @error('Tipo') is-invalid @enderror" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Soporte" {{ old('Tipo') == 'Soporte' ? 'selected' : '' }}>Soporte Técnico</option>
                            <option value="Solicitud de servicio" {{ old('Tipo') == 'Solicitud de servicio' ? 'selected' : '' }}>Solicitud de Servicio</option>
                        </select>
                        @error('Tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="Descripcion" class="col-md-3 col-form-label">Descripción del Problema</label>
                    <div class="col-md-9">
                        <textarea name="Descripcion" id="Descripcion" rows="5" class="form-control @error('Descripcion') is-invalid @enderror" required>{{ old('Descripcion') }}</textarea>
                        @error('Descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            Crear Ticket
                        </button>
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection