@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Editar Ticket #{{ $ticket->idTicket }}</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Información del Ticket</div>
        <div class="card-body">
            <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group row mb-3">
                    <label for="Tipo" class="col-md-3 col-form-label">Tipo de Ticket</label>
                    <div class="col-md-9">
                        <select name="Tipo" id="Tipo" class="form-control @error('Tipo') is-invalid @enderror" required>
                            <option value="Soporte" {{ $ticket->Tipo == 'Soporte' ? 'selected' : '' }}>Soporte Técnico</option>
                            <option value="Solicitud de servicio" {{ $ticket->Tipo == 'Solicitud de servicio' ? 'selected' : '' }}>Solicitud de Servicio</option>
                        </select>
                        @error('Tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="Descripcion" class="col-md-3 col-form-label">Descripción</label>
                    <div class="col-md-9">
                        <textarea name="Descripcion" id="Descripcion" rows="5" class="form-control @error('Descripcion') is-invalid @enderror" required>{{ $ticket->Descripcion }}</textarea>
                        @error('Descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Trabajador'))
                <!-- Solo visible para Admin y Trabajador -->
                <div class="form-group row mb-3">
                    <label for="Prioridad" class="col-md-3 col-form-label">Prioridad</label>
                    <div class="col-md-9">
                        <select name="Prioridad" id="Prioridad" class="form-control @error('Prioridad') is-invalid @enderror" required>
                            <option value="Regular" {{ $ticket->Prioridad == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Urgente" {{ $ticket->Prioridad == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                            <option value="Prioritario" {{ $ticket->Prioridad == 'Prioritario' ? 'selected' : '' }}>Prioritario</option>
                        </select>
                        @error('Prioridad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="Estado" class="col-md-3 col-form-label">Estado</label>
                    <div class="col-md-9">
                        <select name="Estado" id="Estado" class="form-control @error('Estado') is-invalid @enderror" required>
                            <option value="Abierto" {{ $ticket->Estado == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                            <option value="Cerrado" {{ $ticket->Estado == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                        </select>
                        @error('Estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="idGestor" class="col-md-3 col-form-label">Asignado a</label>
                    <div class="col-md-9">
                        <select name="idGestor" id="idGestor" class="form-control @error('idGestor') is-invalid @enderror" 
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
                            <!-- Campo oculto para mantener el valor -->
                            <input type="hidden" name="idGestor" value="{{ $ticket->idGestor }}">
                        @endif
                        @error('idGestor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nuevo campo para Cambios/Comentarios -->
                <div class="form-group row mb-3">
                    <label for="Cambios" class="col-md-3 col-form-label">Comentarios adicionales</label>
                    <div class="col-md-9">
                        <textarea name="Cambios" id="Cambios" rows="3" class="form-control @error('Cambios') is-invalid @enderror" placeholder="Agregue comentarios adicionales que se registrarán en el historial del ticket">{{ old('Cambios') }}</textarea>
                        <small class="form-text text-muted">
                            Los cambios como tipo, estado, prioridad y reasignación se registran automáticamente.
                        </small>
                        @error('Cambios')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @endif

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            Actualizar Ticket
                        </button>
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Historial de cambios del ticket -->
    @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Trabajador'))
    <div class="card mt-4">
        <div class="card-header">Historial de cambios</div>
        <div class="card-body">
            @if($ticket->gestiones->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cambio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ticket->gestiones->sortByDesc('idGestion') as $gestion)
                                <tr>
                                    <td>{{ $gestion->idGestion }}</td>
                                    <td>{{ $gestion->Cambios }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No hay cambios registrados para este ticket.</p>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection