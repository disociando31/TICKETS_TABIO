@extends('layouts.app')

@section('content')
<div class="container solicitud-edit">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Editar Solicitud #{{ $solicitud->idSolicitud }}</h1>
            <h5>Ticket #{{ $solicitud->ticket->idTicket }}</h5>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Información del Ticket</div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Creado por:</div>
                <div class="col-md-9">{{ $solicitud->ticket->usuario->nombre ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Descripción:</div>
                <div class="col-md-9">{{ $solicitud->ticket->Descripcion }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Estado:</div>
                <div class="col-md-9">
                    <span class="badge {{ $solicitud->ticket->Estado == 'Abierto' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $solicitud->ticket->Estado }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Detalles de la Solicitud</div>
        <div class="card-body">
            <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group row mb-3">
                    <label for="idTipoAsistencia" class="col-md-3 col-form-label">Tipo de Asistencia</label>
                    <div class="col-md-9">
                        <select name="idTipoAsistencia" id="idTipoAsistencia" class="form-control @error('idTipoAsistencia') is-invalid @enderror" required>
                            @foreach($tiposAsistencia as $tipo)
                                <option value="{{ $tipo->idTipoAsistencia }}" {{ $solicitud->idTipoAsistencia == $tipo->idTipoAsistencia ? 'selected' : '' }}>
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
                        <input type="text" name="Aplicacion" id="Aplicacion" class="form-control @error('Aplicacion') is-invalid @enderror" value="{{ $solicitud->Aplicacion }}">
                        @error('Aplicacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="ElementosAfectados" class="col-md-3 col-form-label">Elementos Afectados</label>
                    <div class="col-md-9">
                        <textarea name="ElementosAfectados" id="ElementosAfectados" rows="3" class="form-control @error('ElementosAfectados') is-invalid @enderror">{{ $solicitud->ElementosAfectados }}</textarea>
                        @error('ElementosAfectados')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Trabajador'))
                <div class="form-group row mb-3">
                    <label for="Cambios" class="col-md-3 col-form-label">Notas/Cambios</label>
                    <div class="col-md-9">
                        <textarea name="Cambios" id="Cambios" rows="3" class="form-control @error('Cambios') is-invalid @enderror"></textarea>
                        <small class="form-text text-muted">Registre aquí los cambios realizados en esta actualización.</small>
                        @error('Cambios')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                @if($solicitud->ticket->Estado == 'Abierto')
                <div class="form-group row mb-3">
                    <div class="col-md-9 offset-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cerrar-ticket" name="cerrar_ticket" value="1">
                            <label class="form-check-label" for="cerrar-ticket">
                                Cerrar ticket al guardar
                            </label>
                        </div>
                    </div>
                </div>
                @endif
                @endif

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            Actualizar Solicitud
                        </button>
                        <a href="{{ route('solicitudes.show', $solicitud) }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection