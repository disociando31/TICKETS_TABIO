@extends('layouts.app')
@include('partials.accessibility')

@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1 class="usuarios-title">Tickets - {{ $equipo->NombreEquipo }}</h1>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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

    <div class="table-responsive">
        <div class="info-card">
            <div class="info-section">
                <h3>Información del Equipo</h3>
                <div class="detalle-item">
                    <label>Nombre del Equipo:</label>
                    <span class="valor">{{ $equipo->NombreEquipo }}</span>
                </div>
                <div class="detalle-item">
                    <label>Dependencia:</label>
                    <span class="valor">{{ $equipo->dependencia->Dependencia }}</span>
                </div>
            </div>
            
            <div class="info-section">
                <h3>Historial de Tickets</h3>
                @if(!$equipo->tickets || $equipo->tickets->isEmpty())
                    <p class="no-data">No hay tickets registrados para este equipo.</p>
                @else
                    <table class="usuarios-table">
                        <thead>
                            <tr>
                                <th>ID Ticket</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Dependencia</th>
                                <th>Tipo Soporte</th>
                                <th>Tipo Mantenimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipo->tickets as $soporte)
                                <tr>
                                    <td>{{ $soporte->ticket->idTicket }}</td>
                                    <td>{{ $soporte->ticket->FechaCreacion->format('d/m/Y') }}</td>
                                    <td>{{ Str::limit($soporte->ticket->Descripcion, 50) }}</td>
                                    <td>
                                        <span class="usuario-estado {{ $soporte->ticket->Estado == 'Abierto' ? 'activo' : 'inactivo' }}">
                                            {{ $soporte->ticket->Estado }}
                                        </span>
                                    </td>
                                    <td>{{ $soporte->ticket->usuario->dependencia->Dependencia ?? 'N/A' }}</td>
                                    <td>{{ $soporte->TipoSoporte }}</td>
                                    <td>{{ $soporte->TipoMantenimiento }}</td>
                                    <td>
                                        <div class="acciones-grupo">
                                            <a href="{{ route('soportes.show', $soporte->idSoporte) }}" class="btn-editar">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                            @if($soporte->ticket->Estado != 'Cerrado' && auth()->user()->can('update', $soporte))
                                                <a href="{{ route('soportes.edit', $soporte->idSoporte) }}" class="btn-editar">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="actions-container">
        <a href="{{ route('equipos.show', $equipo->idEquipo) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al Equipo
        </a>
    </div>
</div>
@endsection