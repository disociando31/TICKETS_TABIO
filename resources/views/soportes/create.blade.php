@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Crear Detalles de Soporte</h1>
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
        <div class="card-header">Detalles del Soporte</div>
        <div class="card-body">
            <form action="{{ route('soportes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idTicket" value="{{ $ticket->idTicket }}">
                
                <div class="form-group row mb-3">
                    <label for="TipoEquipo" class="col-md-3 col-form-label">Tipo de Equipo</label>
                    <div class="col-md-9">
                        <select name="TipoEquipo" id="TipoEquipo" class="form-control @error('TipoEquipo') is-invalid @enderror" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Impresora" {{ old('TipoEquipo') == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                            <option value="Scanner" {{ old('TipoEquipo') == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                            <option value="Monitor" {{ old('TipoEquipo') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                            <option value="CPU" {{ old('TipoEquipo') == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="Otro" {{ old('TipoEquipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('TipoEquipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Después del campo TipoEquipo y antes de TipoSoporte -->
                <div class="form-group row mb-3">
                    <label for="idEquipo" class="col-md-3 col-form-label">Equipo (Opcional)</label>
                    <div class="col-md-9">
                        <select name="idEquipo" id="idEquipo" class="form-control @error('idEquipo') is-invalid @enderror">
                            <option value="">Ninguno</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->idEquipo }}" {{ old('idEquipo') == $equipo->idEquipo ? 'selected' : '' }}>
                                    {{ $equipo->NombreEquipo }} ({{ $equipo->dependencia->Dependencia ?? 'Sin dependencia' }})
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Seleccione un equipo específico si el soporte está relacionado a uno.</small>
                        @error('idEquipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="TipoSoporte" class="col-md-3 col-form-label">Tipo de Soporte</label>
                    <div class="col-md-9">
                        <select name="TipoSoporte" id="TipoSoporte" class="form-control @error('TipoSoporte') is-invalid @enderror" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Solicitud" {{ old('TipoSoporte') == 'Solicitud' ? 'selected' : '' }}>Solicitud</option>
                            <option value="Diagnostico" {{ old('TipoSoporte') == 'Diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                            <option value="Baja" {{ old('TipoSoporte') == 'Baja' ? 'selected' : '' }}>Baja</option>
                            <option value="Otro" {{ old('TipoSoporte') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('TipoSoporte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="TipoMantenimiento" class="col-md-3 col-form-label">Tipo de Mantenimiento</label>
                    <div class="col-md-9">
                        <select name="TipoMantenimiento" id="TipoMantenimiento" class="form-control @error('TipoMantenimiento') is-invalid @enderror" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Preventivo" {{ old('TipoMantenimiento') == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                            <option value="Correctivo" {{ old('TipoMantenimiento') == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
                        </select>
                        @error('TipoMantenimiento')
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