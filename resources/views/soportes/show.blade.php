@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Soporte Técnico #{{ $soporte->idSoporte }}</h1>
            <h5>Ticket #{{ $soporte->ticket->idTicket }}</h5>
        </div>
        <div class="col-md-4 text-right">
            @if(auth()->user()->can('update', $soporte))
                <a href="{{ route('soportes.edit', $soporte) }}" class="btn btn-warning">
                    Editar Soporte
                </a>
            @endif
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Información del Ticket</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Estado:</div>
                        <div class="col-md-8">
                            <span class="badge {{ $soporte->ticket->Estado == 'Abierto' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $soporte->ticket->Estado }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Prioridad:</div>
                        <div class="col-md-8">
                            <span class="badge 
                                {{ $soporte->ticket->Prioridad == 'Prioritario' ? 'bg-danger' : 
                                   ($soporte->ticket->Prioridad == 'Urgente' ? 'bg-warning' : 'bg-info') }}">
                                {{ $soporte->ticket->Prioridad }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Creado por:</div>
                        <div class="col-md-8">{{ $soporte->ticket->usuario->nombre ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Departamento:</div>
                        <div class="col-md-8">{{ $soporte->ticket->usuario->dependencia->Dependencia ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Teléfono:</div>
                        <div class="col-md-8">{{ $soporte->ticket->usuario->telefono ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Asignado a:</div>
                        <div class="col-md-8">{{ $soporte->ticket->gestor->nombre ?? 'Sin asignar' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Fecha de creación:</div>
                        <div class="col-md-8">{{ $soporte->ticket->FechaCreacion->format('d/m/Y H:i') }}</div>
                    </div>
                    @if($soporte->ticket->FechaCierre)
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Fecha de cierre:</div>
                        <div class="col-md-8">{{ $soporte->ticket->FechaCierre->format('d/m/Y H:i') }}</div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Descripción:</div>
                        <div class="col-md-8">{{ $soporte->ticket->Descripcion }}</div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Detalles del Soporte</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Tipo de Equipo:</div>
                        <div class="col-md-8">{{ $soporte->TipoEquipo }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Tipo de Soporte:</div>
                        <div class="col-md-8">{{ $soporte->TipoSoporte }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Tipo de Mantenimiento:</div>
                        <div class="col-md-8">{{ $soporte->TipoMantenimiento }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Historial de Cambios</div>
                <div class="card-body">
                    @forelse($soporte->ticket->gestiones as $gestion)
                        <div class="alert alert-info mb-2">
                            <div class="small text-muted">{{ $gestion->created_at ? $gestion->created_at->format('d/m/Y H:i') : 'Fecha no disponible' }}</div>
                            <div>{{ $gestion->Cambios }}</div>
                        </div>
                    @empty
                        <p class="text-muted">No hay registros de cambios.</p>
                    @endforelse
                </div>
            </div>

            @if(auth()->user()->hasRole('Administrador') || auth()->user()->hasRole('Trabajador'))
                <div class="card">
                    <div class="card-header">Registrar Cambio</div>
                    <div class="card-body">
                        <form id="add-cambio-form">
                            @csrf
                            <input type="hidden" name="idTicket" value="{{ $soporte->ticket->idTicket }}">
                            <div class="form-group mb-3">
                                <label for="new-cambio">Cambios realizados</label>
                                <textarea name="Cambios" id="new-cambio" rows="3" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Registrar Cambio
                            </button>
                        </form>
                    </div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('add-cambio-form');
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const formData = new FormData(form);
                        fetch('{{ route("api.gestion-tickets.store") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                idTicket: formData.get('idTicket'),
                                Cambios: formData.get('Cambios')
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Reload para mostrar el nuevo cambio
                                location.reload();
                            } else {
                                alert('Error al registrar el cambio: ' + (data.error || 'Error desconocido'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al registrar el cambio');
                        });
                    });
                });
                </script>
            @endif
        </div>
    </div>
</div>
@endsection