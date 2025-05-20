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
            <form action="{{ route('tickets.index') }}" method="GET">
                <div class="row">
                    <!-- Filtros básicos disponibles para todos -->
                    <div class="col-md-3 mb-3">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">Todos</option>
                            <option value="Soporte" {{ request('tipo') == 'Soporte' ? 'selected' : '' }}>Soporte</option>
                            <option value="Solicitud de servicio" {{ request('solicitud') == 'Solicitud de servicio' ? 'selected' : '' }}>Solicitud de servicio</option>
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
                        <button type="submit" class="btn btn-secondary mr-2">Filtrar</button>
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    </div>
                </div>

                <div class="row">
                    <!-- Filtro de rango de fechas - disponible para todos -->
                    <div class="col-md-3 mb-3">
                        <label for="fecha_desde">Fecha desde</label>
                        <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="fecha_hasta">Fecha hasta</label>
                        <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
                    </div>

                    <<!-- Filtro por usuario creador - solo para trabajador y admin -->
                    @if(auth()->user()->hasRole(['Administrador', 'Trabajador']))
                    <div class="col-md-3 mb-3">
                        <label for="creador_nombre">Creado por (nombre)</label>
                        <input type="text" name="creador_nombre" id="creador_nombre" class="form-control" 
                            value="{{ request('creador_nombre') }}" placeholder="Buscar por nombre...">
                    </div>
                    @endif

                    <!-- Filtro por asignado - solo para admin -->
                    @if(auth()->user()->hasRole('Administrador'))
                    <div class="col-md-3 mb-3">
                        <label for="asignado">Asignado a</label>
                        <select name="asignado" id="asignado" class="form-control">
                            <option value="">Todos</option>
                            <option value="sin_asignar" {{ request('asignado') == 'sin_asignar' ? 'selected' : '' }}>Sin asignar</option>
                            @foreach(App\Models\User::role(['Administrador', 'Trabajador'])->orderBy('nombre')->get() as $gestor)
                                <option value="{{ $gestor->idUsuario }}" {{ request('asignado') == $gestor->idUsuario ? 'selected' : '' }}>
                                    {{ $gestor->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
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
                                        <!-- Botón para editar ticket -->
                                        @if(auth()->user()->can('update', $ticket))
                                            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-warning">
                                                Editar Ticket
                                            </a>
                                        @endif
                                        
                                        <!-- Botón para editar Soporte/Solicitud -->
                                        @if($ticket->Tipo == 'Soporte' && $ticket->soporte && auth()->user()->can('update', $ticket->soporte))
                                            <a href="{{ route('soportes.edit', $ticket->soporte) }}" class="btn btn-sm btn-primary ml-1">
                                                Editar Soporte
                                            </a>
                                        @elseif($ticket->Tipo == 'Solicitud de servicio' && $ticket->solicitud && auth()->user()->can('update', $ticket->solicitud))
                                            <a href="{{ route('solicitudes.edit', $ticket->solicitud) }}" class="btn btn-sm btn-primary ml-1">
                                                Editar Solicitud
                                            </a>
                                        @endif
                                        
                                        <!-- Botón para ver detalles (soporte o solicitud) -->
                                        @if($ticket->Tipo == 'Soporte' && $ticket->soporte)
                                            <a href="{{ route('soportes.show', $ticket->soporte) }}" class="btn btn-sm btn-info ml-1">
                                                Ver Detalles
                                            </a>
                                        @elseif($ticket->Tipo == 'Solicitud de servicio' && $ticket->solicitud)
                                            <a href="{{ route('solicitudes.show', $ticket->solicitud) }}" class="btn btn-sm btn-info ml-1">
                                                Ver Detalles
                                            </a>
                                        @elseif($ticket->Tipo == 'Soporte' && !$ticket->soporte)
                                            <a href="{{ route('soportes.create', $ticket) }}" class="btn btn-sm btn-success ml-1">
                                                Completar Soporte
                                            </a>
                                        @elseif($ticket->Tipo == 'Solicitud de servicio' && !$ticket->solicitud)
                                            <a href="{{ route('solicitudes.create', $ticket) }}" class="btn btn-sm btn-success ml-1">
                                                Completar Solicitud
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