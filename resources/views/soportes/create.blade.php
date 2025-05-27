@extends('layouts.app')

@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Crear Detalles de Soporte</h1>
        <h5 class="text-white">Para ticket #{{ $ticket->idTicket }}</h5>
    </div>

    <div class="ticket-info-section">
        <h3>Información del Ticket</h3>
        <div class="info-grid">
            <div class="info-item">
                <label>Creado por:</label>
                <span>{{ $ticket->usuario->nombre ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <label>Departamento:</label>
                <span>{{ $ticket->usuario->dependencia->Dependencia ?? 'N/A' }}</span>
            </div>
            <div class="info-item full-width">
                <label>Descripción:</label>
                <span>{{ $ticket->Descripcion }}</span>
            </div>
            <div class="info-item">
                <label>Prioridad:</label>
                <span class="badge {{ $ticket->Prioridad == 'Prioritario' ? 'bg-danger' : 
                    ($ticket->Prioridad == 'Urgente' ? 'bg-warning' : 'bg-info') }}">
                    {{ $ticket->Prioridad }}
                </span>
            </div>
        </div>
    </div>

    <form action="{{ route('soportes.store') }}" method="POST">
        @csrf
        <input type="hidden" name="idTicket" value="{{ $ticket->idTicket }}">
        
        <div class="form-group">
            <label for="TipoEquipo">Tipo de Equipo</label>
            <select name="TipoEquipo" id="TipoEquipo" class="@error('TipoEquipo') is-invalid @enderror" required>
                <option value="">Seleccione un tipo</option>
                <option value="Impresora" {{ old('TipoEquipo') == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                <option value="Scanner" {{ old('TipoEquipo') == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                <option value="Monitor" {{ old('TipoEquipo') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                <option value="CPU" {{ old('TipoEquipo') == 'CPU' ? 'selected' : '' }}>CPU</option>
                <option value="Otro" {{ old('TipoEquipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
            @error('TipoEquipo')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="idEquipo">Equipo (Opcional)</label>
            <select name="idEquipo" id="idEquipo" class="@error('idEquipo') is-invalid @enderror">
                <option value="">Ninguno</option>
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->idEquipo }}" {{ old('idEquipo') == $equipo->idEquipo ? 'selected' : '' }}>
                        {{ $equipo->NombreEquipo }} ({{ $equipo->dependencia->Dependencia ?? 'Sin dependencia' }})
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Seleccione un equipo específico si el soporte está relacionado a uno.</small>
            @error('idEquipo')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="TipoSoporte">Tipo de Soporte</label>
            <select name="TipoSoporte" id="TipoSoporte" class="@error('TipoSoporte') is-invalid @enderror" required>
                <option value="">Seleccione un tipo</option>
                <option value="Solicitud" {{ old('TipoSoporte') == 'Solicitud' ? 'selected' : '' }}>Solicitud</option>
                <option value="Diagnostico" {{ old('TipoSoporte') == 'Diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                <option value="Baja" {{ old('TipoSoporte') == 'Baja' ? 'selected' : '' }}>Baja</option>
                <option value="Otro" {{ old('TipoSoporte') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
            @error('TipoSoporte')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="TipoMantenimiento">Tipo de Mantenimiento</label>
            <select name="TipoMantenimiento" id="TipoMantenimiento" class="@error('TipoMantenimiento') is-invalid @enderror" required>
                <option value="">Seleccione un tipo</option>
                <option value="Preventivo" {{ old('TipoMantenimiento') == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                <option value="Correctivo" {{ old('TipoMantenimiento') == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
            </select>
            @error('TipoMantenimiento')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>

        @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Trabajador'))
        <div class="form-group">
            <label for="Cambios">Notas/Cambios</label>
            <textarea name="Cambios" id="Cambios" rows="3" class="@error('Cambios') is-invalid @enderror">{{ old('Cambios') }}</textarea>
            @error('Cambios')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
        @endif

        <div class="buttons-container">
            <button type="submit">Guardar Detalles</button>
            <a href="{{ route('tickets.index') }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection