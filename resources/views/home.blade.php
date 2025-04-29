@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard {{ $rol }}</h1>
    
    <div>
        <h3>Opciones disponibles:</h3>
        <ul>
            @if(auth()->user()->hasRole('Administrador'))
                <li><a href="{{ route('usuarios.index') }}">Gestionar Usuarios</a></li>
                <li><a href="{{ route('usuarios.create') }}">Crear Usuario</a></li>
            @endif
            
            @if(auth()->user()->hasPermissionTo('gestionar_perfil'))
                <li><a href="{{ route('perfil') }}">Editar mi perfil</a></li>
            @endif
            
            @if(auth()->user()->hasPermissionTo('gestionar_tickets_propios'))
                <li><a href="#">Mis Tickets</a></li>
                <li><a href="#">Crear Ticket</a></li>
            @endif
            
            @if(auth()->user()->hasPermissionTo('gestionar_todos_tickets'))
                <li><a href="#">Gestionar Todos los Tickets</a></li>
            @endif
            
            @if(auth()->user()->hasPermissionTo('asignar_tickets'))
                <li><a href="#">Asignar Tickets</a></li>
            @endif
            
            @if(auth()->user()->hasPermissionTo('gestionar_equipos'))
                <li><a href="#">Gestionar Equipos</a></li>
            @endif
            
            @if(auth()->user()->hasPermissionTo('gestionar_reportes'))
                <li><a href="#">Reportes</a></li>
            @endif
        </ul>
    </div>
</div>
@endsection