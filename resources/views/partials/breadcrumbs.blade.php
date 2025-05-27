<nav class="breadcrumbs-govco" aria-label="breadcrumb">
    <ol class="breadcrumbs-list">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">
                <i class="fas fa-home"></i>
                Inicio
            </a>
        </li>
        
        @foreach(request()->segments() as $segment)
            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                @if($loop->last)
                    @php
                        $currentPath = request()->path();
                        $parentSegment = explode('/', $currentPath)[0];
                    @endphp

                    @switch($segment)
                        @case('create')
                            @switch($parentSegment)
                                @case('roles')
                                    Crear Rol
                                    @break
                                @case('dependencias')
                                    Crear Dependencia
                                    @break
                                @case('equipos')
                                    Crear Equipo
                                    @break
                                @case('tickets')
                                    Crear Ticket
                                    @break
                                @case('soportes')
                                    Crear Soporte
                                    @break
                                @case('solicitudes')
                                    Crear Solicitud
                                    @break
                                @case('usuarios')
                                    Crear Usuario
                                    @break
                            @endswitch
                            @break
                        @case('edit')
                            @switch($parentSegment)
                                @case('roles')
                                    Editar Rol
                                    @break
                                @case('dependencias')
                                    Editar Dependencia
                                    @break
                                @case('equipos')
                                    Editar Equipo
                                    @break
                                @case('tickets')
                                    Editar Ticket
                                    @break
                                @case('soportes')
                                    Editar Soporte
                                    @break
                                @case('solicitudes')
                                    Editar Solicitud
                                    @break
                                @case('usuarios')
                                    Editar Usuario
                                    @break
                            @endswitch
                            @break
                        @case('show')
                            @switch($parentSegment)
                                @case('roles')
                                    Detalles del Rol
                                    @break
                                @case('dependencias')
                                    Detalles de la Dependencia
                                    @break
                                @case('equipos')
                                    Detalles del Equipo
                                    @break
                                @case('tickets')
                                    Detalles del Ticket
                                    @break
                                @case('soportes')
                                    Detalles del Soporte
                                    @break
                                @case('solicitudes')
                                    Detalles de la Solicitud
                                    @break
                                @case('usuarios')
                                    Detalles del Usuario
                                    @break
                            @endswitch
                            @break
                        @case('usuarios')
                            Listado de Usuarios
                            @break
                        @case('roles')
                            Listado de Roles
                            @break
                        @case('dependencias')
                            Listado de Dependencias
                            @break
                        @case('equipos')
                            Listado de Equipos
                            @break
                        @case('tickets')
                            Listado de Tickets
                            @break
                        @case('soportes')
                            Listado de Soportes
                            @break
                        @case('solicitudes')
                            Listado de Solicitudes
                            @break
                        @case('perfil')
                            Mi Perfil
                            @break
                        @default
                            {{ ucfirst($segment) }}
                    @endswitch
                @else
                    <a href="{{ url(implode('/', array_slice(request()->segments(), 0, $loop->iteration))) }}">
                        @switch($segment)
                            @case('usuarios')
                                Usuarios
                                @break
                            @case('roles')
                                Roles
                                @break
                            @case('dependencias')
                                Dependencias
                                @break
                            @case('equipos')
                                Equipos
                                @break
                            @case('tickets')
                                Tickets
                                @break
                            @case('soportes')
                                Soportes
                                @break
                            @case('solicitudes')
                                Solicitudes
                                @break
                            @default
                                {{ ucfirst($segment) }}
                        @endswitch
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>