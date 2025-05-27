@extends('layouts.app')

@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Editar Soporte #{{ $soporte->idSoporte }}</h1>
        <h5 class="text-white">Ticket #{{ $soporte->ticket->idTicket }}</h5>
    </div>

    <div class="ticket-info-section">
        <h3>Información del Ticket</h3>
        <div class="info-grid">
            <div class="info-item">
                <label>Creado por:</label>
                <span>{{ $soporte->ticket->usuario->nombre ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <label>Estado:</label>
                <span class="badge {{ $soporte->ticket->Estado == 'Abierto' ? 'bg-success' : 'bg-secondary' }}">
                    {{ $soporte->ticket->Estado }}
                </span>
            </div>
            <div class="info-item full-width">
                <label>Descripción:</label>
                <span>{{ $soporte->ticket->Descripcion }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('soportes.update', $soporte) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="TipoEquipo">Tipo de Equipo</label>
            <select name="TipoEquipo" id="TipoEquipo" class="@error('TipoEquipo') is-invalid @enderror" required>
                <option value="Impresora" {{ $soporte->TipoEquipo == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                <option value="Scanner" {{ $soporte->TipoEquipo == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                <option value="Monitor" {{ $soporte->TipoEquipo == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                <option value="CPU" {{ $soporte->TipoEquipo == 'CPU' ? 'selected' : '' }}>CPU</option>
                <option value="Otro" {{ $soporte->TipoEquipo == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                    <option value="{{ $equipo->idEquipo }}" {{ $soporte->idEquipo == $equipo->idEquipo ? 'selected' : '' }}>
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
                <option value="Solicitud" {{ $soporte->TipoSoporte == 'Solicitud' ? 'selected' : '' }}>Solicitud</option>
                <option value="Diagnostico" {{ $soporte->TipoSoporte == 'Diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                <option value="Baja" {{ $soporte->TipoSoporte == 'Baja' ? 'selected' : '' }}>Baja</option>
                <option value="Otro" {{ $soporte->TipoSoporte == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                <option value="Preventivo" {{ $soporte->TipoMantenimiento == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                <option value="Correctivo" {{ $soporte->TipoMantenimiento == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
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
            <textarea name="Cambios" id="Cambios" rows="3" class="@error('Cambios') is-invalid @enderror"></textarea>
            <small class="form-text text-muted">Registre aquí los cambios realizados en esta actualización.</small>
            @error('Cambios')
                <div class="error-container">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
        
        @if($soporte->ticket->Estado == 'Abierto')
        <div class="form-group checkbox-container">
            <div class="custom-checkbox">
                <input type="checkbox" id="cerrar-ticket" name="cerrar_ticket" value="1">
                <label for="cerrar-ticket">
                    Cerrar ticket al guardar
                </label>
            </div>
        </div>
        @endif
        @endif

        <div class="buttons-container">
            <button type="submit">Actualizar Soporte</button>
            <a href="{{ route('soportes.show', $soporte) }}">Cancelar</a>
        </div>
    </form>
</div>
@endsection