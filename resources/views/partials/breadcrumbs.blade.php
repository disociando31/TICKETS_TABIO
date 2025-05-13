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
                    @switch($segment)
                        @case('usuarios')
                            Listado de Usuarios
                            @break
                        @case('create')
                            Crear Usuario
                            @break
                        @case('edit')
                            Editar Usuario
                            @break
                        @case('show')
                            Detalles del Usuario
                            @break
                        @case('perfil')
                            Mi Perfil
                            @break
                        @case('tickets')
                            Listado de Tickets
                            @break
                        @case('dependencias')
                            Listado de Dependencias
                            @break
                        @default
                            {{ ucfirst($segment) }}
                    @endswitch
                @else
                    <a href="{{ url(implode('/', array_slice(request()->segments(), 0, $loop->iteration))) }}">
                        @switch($segment)
                            @case('usuarios')
                                Listado de Usuarios
                                @break
                            @case('tickets')
                                Listado de Tickets
                                @break
                            @case('dependencias')
                                Listado de Dependencias
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