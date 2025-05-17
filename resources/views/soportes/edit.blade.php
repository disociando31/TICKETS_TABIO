@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Editar Soporte #{{ $soporte->idSoporte }}</h1>
            <h5>Ticket #{{ $soporte->ticket->idTicket }}</h5>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Información del Ticket</div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Creado por:</div>
                <div class="col-md-9">{{ $soporte->ticket->usuario->nombre ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Descripción:</div>
                <div class="col-md-9">{{ $soporte->ticket->Descripcion }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Estado:</div>
                <div class="col-md-9">
                    <span class="badge {{ $soporte->ticket->Estado == 'Abierto' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $soporte->ticket->Estado }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Detalles del Soporte</div>
        <div class="card-body">
            <form action="{{ route('soportes.update', $soporte) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group row mb-3">
                    <label for="TipoEquipo" class="col-md-3 col-form-label">Tipo de Equipo</label>
                    <div class="col-md-9">
                        <select name="TipoEquipo" id="TipoEquipo" class="form-control @error('TipoEquipo') is-invalid @enderror" required>
                            <option value="Impresora" {{ $soporte->TipoEquipo == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                            <option value="Scanner" {{ $soporte->TipoEquipo == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                            <option value="Monitor" {{ $soporte->TipoEquipo == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                            <option value="CPU" {{ $soporte->TipoEquipo == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="Otro" {{ $soporte->TipoEquipo == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('TipoEquipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="TipoSoporte" class="col-md-3 col-form-label">Tipo de Soporte</label>
                    <div class="col-md-9">
                        <select name="TipoSoporte" id="TipoSoporte" class="form-control @error('TipoSoporte') is-invalid @enderror" required>
                            <option value="Solicitud" {{ $soporte->TipoSoporte == 'Solicitud' ? 'selected' : '' }}>Solicitud</option>
                            <option value="Diagnostico" {{ $soporte->TipoSoporte == 'Diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                            <option value="Baja" {{ $soporte->TipoSoporte == 'Baja' ? 'selected' : '' }}>Baja</option>
                            <option value="Otro" {{ $soporte->TipoSoporte == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                            <option value="Preventivo" {{ $soporte->TipoMantenimiento == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                            <option value="Correctivo" {{ $soporte->TipoMantenimiento == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
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
                        <textarea name="Cambios" id="Cambios" rows="3" class="form-control @error('Cambios') is-invalid @enderror"></textarea>
                        <small class="form-text text-muted">Registre aquí los cambios realizados en esta actualización.</small>
                        @error('Cambios')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                @if($soporte->ticket->Estado == 'Abierto')
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
                            Actualizar Soporte
                        </button>
                        <a href="{{ route('soportes.show', $soporte) }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection