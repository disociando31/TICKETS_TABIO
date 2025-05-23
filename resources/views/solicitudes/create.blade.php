@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Crear Detalles de Solicitud</h1>
            <h5>Para ticket #{{ $ticket->idTicket }}</h5>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Información del Ticket</div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Creado por:</div>
                <div class="col-md-9">{{ $ticket->usuario->nombre ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Departamento:</div>
                <div class="col-md-9">{{ $ticket->usuario->dependencia->Dependencia ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Descripción:</div>
                <div class="col-md-9">{{ $ticket->Descripcion }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Prioridad:</div>
                <div class="col-md-9">
                    <span class="badge 
                        {{ $ticket->Prioridad == 'Prioritario' ? 'bg-danger' : 
                           ($ticket->Prioridad == 'Urgente' ? 'bg-warning' : 'bg-info') }}">
                        {{ $ticket->Prioridad }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Detalles de la Solicitud</div>
        <div class="card-body">
            <form action="{{ route('solicitudes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idTicket" value="{{ $ticket->idTicket }}">
                
                <div class="form-group row mb-3">
                    <label for="idTipoAsistencia" class="col-md-3 col-form-label">Tipo de Asistencia</label>
                    <div class="col-md-9">
                        <select name="idTipoAsistencia" id="idTipoAsistencia" class="form-control @error('idTipoAsistencia') is-invalid @enderror" required>
                            <option value="">Seleccione un tipo</option>
                            @foreach($tiposAsistencia as $tipo)
                                <option value="{{ $tipo->idTipoAsistencia }}" {{ old('idTipoAsistencia') == $tipo->idTipoAsistencia ? 'selected' : '' }}>
                                    {{ $tipo->TipoAsistencia }}
                                </option>
                            @endforeach
                        </select>
                        @error('idTipoAsistencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="Aplicacion" class="col-md-3 col-form-label">Aplicación</label>
                    <div class="col-md-9">
                        <input type="text" name="Aplicacion" id="Aplicacion" class="form-control @error('Aplicacion') is-invalid @enderror" value="{{ old('Aplicacion') }}">
                        @error('Aplicacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="ElementosAfectados" class="col-md-3 col-form-label">Elementos Afectados</label>
                    <div class="col-md-9">
                        <textarea name="ElementosAfectados" id="ElementosAfectados" rows="3" class="form-control @error('ElementosAfectados') is-invalid @enderror">{{ old('ElementosAfectados') }}</textarea>
                        @error('ElementosAfectados')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Trabajador'))
                <div class="form-group row mb-3">
                    <label for="Cambios" class="col-md-3 col-form-label">Notas/Cambios</label>
                    <div class="col-md-9">
                        <textarea name="Cambios" id="Cambios" rows="3" class="form-control @error('Cambios') is-invalid @enderror">{{ old('Cambios') }}</textarea>
                        @error('Cambios')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @endif

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            Guardar Detalles
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