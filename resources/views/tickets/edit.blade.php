@extends('layouts.app')

@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Editar Ticket #{{ $ticket->idTicket }}</h1>
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

    <form action="{{ route('tickets.update', $ticket) }}" method="POST">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="action" id="form-action" value="save">
        
        <div class="form-group">
            <label for="Tipo">Tipo de Ticket:</label>
            <select name="Tipo" id="Tipo" class="@error('Tipo') is-invalid @enderror" required>
                <option value="Soporte" {{ $ticket->Tipo == 'Soporte' ? 'selected' : '' }}>Soporte Técnico</option>
                <option value="Solicitud de servicio" {{ $ticket->Tipo == 'Solicitud de servicio' ? 'selected' : '' }}>Solicitud de Servicio</option>
            </select>
            @error('Tipo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="Descripcion">Descripción:</label>
            <textarea name="Descripcion" id="Descripcion" rows="5" class="@error('Descripcion') is-invalid @enderror" required>{{ $ticket->Descripcion }}</textarea>
            @error('Descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="Prioridad">Prioridad:</label>
            <select name="Prioridad" id="Prioridad" class="@error('Prioridad') is-invalid @enderror" required>
                <option value="Regular" {{ $ticket->Prioridad == 'Regular' ? 'selected' : '' }}>Regular</option>
                <option value="Urgente" {{ $ticket->Prioridad == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                <option value="Prioritario" {{ $ticket->Prioridad == 'Prioritario' ? 'selected' : '' }}>Prioritario</option>
            </select>
            @error('Prioridad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Trabajador'))
        <div class="form-group">
            <label for="Estado">Estado:</label>
            <select name="Estado" id="Estado" class="@error('Estado') is-invalid @enderror" required>
                <option value="Abierto" {{ $ticket->Estado == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                <option value="Cerrado" {{ $ticket->Estado == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
            </select>
            @error('Estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="idGestor">Asignado a:</label>
            <select name="idGestor" id="idGestor" class="@error('idGestor') is-invalid @enderror" 
                {{ !auth()->user()->hasRole('Administrador') ? 'disabled' : '' }}>
                <option value="">Sin asignar</option>
                @foreach(App\Models\User::role(['Administrador', 'Trabajador'])->get() as $gestor)
                    <option value="{{ $gestor->idUsuario }}" {{ $ticket->idGestor == $gestor->idUsuario ? 'selected' : '' }}>
                        {{ $gestor->nombre }} ({{ $gestor->hasRole('Administrador') ? 'Admin' : 'Trabajador' }})
                    </option>
                @endforeach
            </select>
            @if(!auth()->user()->hasRole('Administrador'))
                <small class="form-text text-muted">Solo los administradores pueden reasignar tickets.</small>
                <input type="hidden" name="idGestor" value="{{ $ticket->idGestor }}">
            @endif
            @error('idGestor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="Cambios">Comentarios adicionales:</label>
            <textarea name="Cambios" id="Cambios" rows="3" class="@error('Cambios') is-invalid @enderror" 
                placeholder="Agregue comentarios adicionales que se registrarán en el historial del ticket">{{ old('Cambios') }}</textarea>
            <small class="form-text text-muted">
                Los cambios como tipo, estado, prioridad y reasignación se registran automáticamente.
            </small>
            @error('Cambios')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <div class="buttons-container">
            <button type="submit" onclick="document.getElementById('form-action').value='save'">
                Guardar
            </button>
            
            @if($ticket->Tipo == 'Soporte')
                <button type="submit" onclick="document.getElementById('form-action').value='continue_soporte'">
                    {{ $ticket->soporte ? 'Continuar a editar Soporte' : 'Continuar a crear Soporte' }}
                </button>
            @elseif($ticket->Tipo == 'Solicitud de servicio')
                <button type="submit" onclick="document.getElementById('form-action').value='continue_solicitud'">
                    {{ $ticket->solicitud ? 'Continuar a editar Solicitud' : 'Continuar a crear Solicitud' }}
                </button>
            @endif
            
            <a href="{{ route('tickets.index') }}">Cancelar</a>
        </div>
    </form>

    @if($ticket->gestiones->count() > 0)
    <div class="historial-section">
        <h3>Historial de cambios</h3>
        <div class="historial-table">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Cambio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ticket->gestiones->sortByDesc('created_at') as $gestion)
                        <tr>
                            <td class="fecha-column">{{ $gestion->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="cambio-column">{{ $gestion->Cambios }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No hay cambios registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection