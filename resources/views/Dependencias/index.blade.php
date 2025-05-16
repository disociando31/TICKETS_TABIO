@extends('layouts.app')

@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1 class="usuarios-title">Listado de Dependencias</h1>
        <a href="{{ route('dependencias.create') }}" class="btn-crear">
            <i class="fas fa-plus"></i> Nueva Dependencia
        </a>
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

    <div class="table-responsive">
        <table class="usuarios-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dependencias as $dependencia)
                    <tr>
                        <td>{{ $dependencia->idDependencia }}</td>
                        <td>{{ $dependencia->Dependencia }}</td>
                        <td>
                            <span class="usuario-estado {{ $dependencia->Estado == 'A' ? 'activo' : 'inactivo' }}">
                                {{ $dependencia->Estado == 'A' ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <div class="acciones-grupo">
                                <a href="{{ route('dependencias.show', $dependencia->idDependencia) }}" 
                                   class="btn-editar">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                
                                <a href="{{ route('dependencias.edit', $dependencia->idDependencia) }}" 
                                   class="btn-editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('dependencias.toggle-estado', $dependencia->idDependencia) }}" 
                                      method="POST" 
                                      style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn-editar"
                                            onclick="return confirm('¿Está seguro de {{ $dependencia->Estado == 'A' ? 'desactivar' : 'activar' }} esta dependencia?')">
                                        <i class="fas fa-power-off"></i>
                                        {{ $dependencia->Estado == 'A' ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>

                                <form action="{{ route('dependencias.destroy', $dependencia->idDependencia) }}" 
                                      method="POST" 
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar esta dependencia?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection