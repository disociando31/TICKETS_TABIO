@extends('layouts.app')

@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1>Listado de Equipos</h1>
        @can('gestionar_equipos')
            <a href="{{ route('equipos.create') }}" class="btn-crear-usuario">Crear Nuevo Equipo</a>
        @endcan
    </div>
    
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="usuarios-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Equipo</th>
                    <th>Dependencia</th>
                    <th>Fecha Adquisición</th>
                    <th>Hardware</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->idEquipo }}</td>
                        <td>{{ $equipo->NombreEquipo }}</td>
                        <td>{{ $equipo->dependencia->Dependencia ?? 'No asignada' }}</td>
                        <td>{{ $equipo->FechaAdquisicion }}</td>
                        <td>
                            @if($equipo->hardware && $equipo->hardware->count() > 0)
                                @foreach($equipo->hardware as $hw)
                                    <div class="hardware-info">
                                        <small>{{ $hw->Procesador ?? 'No especificado' }}</small>
                                    </div>
                                @endforeach
                            @else
                                <span class="no-data">Sin hardware registrado</span>
                            @endif
                        </td>
                        <td>
                            <div class="acciones-grupo">
                                <a href="{{ route('equipos.show', $equipo->idEquipo) }}" 
                                   class="btn-ver">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                
                                <a href="{{ route('equipos.edit', $equipo->idEquipo) }}" 
                                   class="btn-editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <a href="{{ route('equipos.configRed', $equipo->idEquipo) }}" 
                                   class="btn-config">
                                    <i class="fas fa-network-wired"></i> Red
                                </a>

                                <a href="{{ route('equipos.hardware', $equipo->idEquipo) }}" 
                                   class="btn-hardware">
                                    <i class="fas fa-microchip"></i> Hardware
                                </a>

                                <a href="{{ route('equipos.software_instalados', $equipo->idEquipo) }}" 
                                   class="btn-software">
                                    <i class="fas fa-laptop-code"></i> Software
                                </a>

                                <a href="{{ route('equipos.tickets', $equipo->idEquipo) }}" 
                                   class="btn-tickets">
                                    <i class="fas fa-ticket-alt"></i> Tickets
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
