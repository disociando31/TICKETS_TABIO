@extends('layouts.app')

@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1 class="usuarios-title">Gestión de Tickets</h1>
        <a href="{{ route('tickets.create') }}" class="btn-crear">Nuevo Ticket</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario de búsqueda y filtros -->
    <div class="usuarios-filters">
        <form action="{{ route('tickets.index') }}" method="GET" class="search-form">
            <div class="search-container full-width">
                <input type="text" 
                    name="creador_nombre" 
                    id="creador_nombre" 
                    class="search-input" 
                    value="{{ request('creador_nombre') }}" 
                    placeholder="Buscar por nombre...">
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <div class="filter-group">
                <!-- Filtros básicos disponibles para todos -->
                <div class="col-md-3 mb-3">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="filter-dropdown">
                        <option value="">Todos</option>
                        <option value="Soporte" {{ request('tipo') == 'Soporte' ? 'selected' : '' }}>Soporte</option>
                        <option value="Solicitud de servicio" {{ request('solicitud') == 'Solicitud de servicio' ? 'selected' : '' }}>Solicitud de servicio</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="filter-dropdown">
                        <option value="">Todos</option>
                        <option value="Abierto" {{ request('estado') == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                        <option value="Cerrado" {{ request('estado') == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="prioridad">Prioridad</label>
                    <select name="prioridad" id="prioridad" class="filter-dropdown">
                        <option value="">Todas</option>
                        <option value="Regular" {{ request('prioridad') == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Urgente" {{ request('prioridad') == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                        <option value="Prioritario" {{ request('prioridad') == 'Prioritario' ? 'selected' : '' }}>Prioritario</option>
                    </select>
                </div>
            </div>

            <div class="filter-group">
                <div class="col-md-3 mb-3">
                    <label for="fecha_desde">Fecha desde</label>
                    <input type="date" name="fecha_desde" id="fecha_desde" class="filter-dropdown" value="{{ request('fecha_desde') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="fecha_hasta">Fecha hasta</label>
                    <input type="date" name="fecha_hasta" id="fecha_hasta" class="filter-dropdown" value="{{ request('fecha_hasta') }}">
                </div>

                @if(auth()->user()->hasRole(['Administrador', 'Trabajador']))
                
                @endif

                @if(auth()->user()->hasRole('Administrador'))
                <div class="col-md-3 mb-3">
                    <label for="asignado">Asignado a</label>
                    <select name="asignado" id="asignado" class="filter-dropdown">
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
                
                <button type="submit" class="btn-filtrar">Filtrar</button>
                <a href="{{ route('tickets.index') }}" class="btn-filtrar">Limpiar</a>
            </div>
        </form>
    </div>

    <!-- Tabla de tickets -->
    <div class="table-responsive">
        <table class="usuarios-table">
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
                            <div class="acciones-grupo">
                                @if(auth()->user()->can('update', $ticket))
                                    <a href="{{ route('tickets.edit', $ticket) }}" class="btn-editar">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                @endif
                                
                                @if($ticket->Tipo == 'Soporte' && $ticket->soporte)
                                    <a href="{{ route('soportes.show', $ticket->soporte) }}" class="btn-ver">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                @elseif($ticket->Tipo == 'Solicitud de servicio' && $ticket->solicitud)
                                    <a href="{{ route('solicitudes.show', $ticket->solicitud) }}" class="btn-ver">
                                        <i class="fas fa-eye"></i> Ver
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
    
    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $tickets->links() }}
    </div>
</div>
@endsection