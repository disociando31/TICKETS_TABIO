@extends('partials.accessibility')

@extends('layouts.app')

@section('content')

<div class="home-container">
    <div class="container">
        <h1>Dashboard {{ $rol }}</h1>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @php
            $hasActiveRoles = auth()->user()->roles()->where('estado', true)->exists();
        @endphp

        @if(!$hasActiveRoles)
            <div class="alert alert-danger">
                <h4 class="alert-heading">Rol desactivado</h4>
                <p>Su rol ha sido desactivado. Por favor contacte al administrador del sistema.</p>
            </div>
        @else
            <div>
                <h3>Opciones disponibles:</h3>
                <ul>
                    @if(auth()->user()->hasPermissionTo('gestionar_usuarios'))
                        <li><a href="{{ route('usuarios.index') }}">Gestionar Usuarios</a></li>
                        <li><a href="{{ route('usuarios.create') }}">Crear Usuario</a></li>
                    @endif
                    @if(auth()->user()->hasPermissionTo('gestionar_roles'))
                        <li><a href="{{ route('roles.index') }}">Gestionar Roles</a></li>
                        <li><a href="{{ route('roles.create') }}">Crear Rol</a></li>
                        <li><a href="{{ route('dependencias.index') }}">Gestionar Dependencias</a></li>
                        <li><a href="{{ route('dependencias.create') }}">Crear Dependencia</a></li>
                    @endif
                    
                    @if(auth()->user()->hasPermissionTo('gestionar_perfil'))
                        <li><a href="{{ route('perfil') }}">Editar mi perfil</a></li>
                    @endif
                    @if(auth()->user()->hasPermissionTo('gestionar_tickets_propios'))
                        <li><a href="{{ route('tickets.index') }}"> Tickets</a></li>
                        <li><a href="{{ route('tickets.create') }}">Crear Ticket</a></li>
                    @endif

                    @if(auth()->user()->hasPermissionTo('gestionar_equipos'))
                        <li><a href="{{ route('equipos.index') }}">Gestionar Equipos</a></li>
                        <li><a href="{{ route('equipos.create') }}">Crear Equipos</a></li>

                    @endif

                </ul>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('partials.accessibility')

