@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Gestión de Tickets</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('tickets.create') }}" class="btn btn-primary">Nuevo Ticket</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Filtros</div>
        <div class="card-body">
            <form action="{{ route('tickets.index') }}" method="GET" class="row">
                <div class="col-md-3 mb-3">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="">Todos</option>
                        <option value="Soporte" {{ request('tipo') == 'Soporte' ? 'selected' : '' }}>Soporte</option>
                        <option value="Solicitud de servicio" {{ request('tipo') == 'Solicitud de servicio' ? 'selected' : '' }}>Solicitud de servicio</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="">Todos</option>
                        <option value="Abierto" {{ request('estado') == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                        <option value="Cerrado" {{ request('estado') == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="prioridad">Prioridad</label>
                    <select name="prioridad" id="prioridad" class="form-control">
                        <option value="">Todas</option>
                        <option value="Regular" {{ request('prioridad') == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Urgente" {{ request('prioridad') == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                        <option value="Prioritario" {{ request('prioridad') == 'Prioritario' ? 'selected' : '' }}>Prioritario</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-secondary">Filtrar</button>
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary ml-2">Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Listado de Tickets</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Prioridad</th>
                            <th>Creado por</th>
                            <th>Asignado a</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->idTicket }}</td>
                                <td>{{ $ticket->Tipo }}</td>
                                <td>{{ Str::limit($ticket->Descripcion, 30) }}</td>
                                <td>
                                    <span class="badge {{ $ticket->Estado == 'Abierto' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $ticket->Estado }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge 
                                        {{ $ticket->Prioridad == 'Prioritario' ? 'bg-danger' : 
                                           ($ticket->Prioridad == 'Urgente' ? 'bg-warning' : 'bg-info') }}">
                                        {{ $ticket->Prioridad }}
                                    </span>
                                </td>
                                <td>{{ $ticket->usuario->nombre ?? 'N/A' }}</td>
                                <td>{{ $ticket->gestor->nombre ?? 'Sin asignar' }}</td>
                                <td>{{ $ticket->FechaCreacion->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <!-- Botón para ver detalles (soporte o solicitud) -->
                                        @if($ticket->Tipo == 'Soporte' && $ticket->soporte)
                                            <a href="{{ route('soportes.show', $ticket->soporte) }}" class="btn btn-sm btn-info">
                                                Ver Detalles
                                            </a>
                                        @elseif($ticket->Tipo == 'Solicitud de servicio' && $ticket->solicitud)
                                            <a href="{{ route('solicitudes.show', $ticket->solicitud) }}" class="btn btn-sm btn-info">
                                                Ver Detalles
                                            </a>
                                        @elseif($ticket->Tipo == 'Soporte' && !$ticket->soporte)
                                            <a href="{{ route('soportes.create', $ticket) }}" class="btn btn-sm btn-primary">
                                                Completar Soporte
                                            </a>
                                        @elseif($ticket->Tipo == 'Solicitud de servicio' && !$ticket->solicitud)
                                            <a href="{{ route('solicitudes.create', $ticket) }}" class="btn btn-sm btn-primary">
                                                Completar Solicitud
                                            </a>
                                        @endif
                                        
                                        <!-- Botón para editar ticket -->
                                        @if(auth()->user()->hasRole('Administrador') || 
                                            (auth()->user()->hasRole('Trabajador') && 
                                            (auth()->id() == $ticket->idUsuario || auth()->id() == $ticket->idGestor)))
                                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-warning ml-1">
                                                Editar
                                            </a>
                                        @elseif(auth()->user()->hasRole('Usuario') && auth()->id() == $ticket->idUsuario)
                                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-warning ml-1">
                                                Editar
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No hay tickets disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $tickets->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection