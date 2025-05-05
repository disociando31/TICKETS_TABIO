<!DOCTYPE html>
<html>
<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="dashboard-admin">
        <h1>Dashboard Administrador</h1>
        
        <div class="options-container">
            <a href="{{ route('usuarios.index') }}">
                <i class="fas fa-users"></i>
                Gestionar Usuarios
            </a>
            
            <a href="{{ route('usuarios.create') }}">
                <i class="fas fa-user-plus"></i>
                Crear Usuario
            </a>
            
            <a href="{{ route('roles.index') }}">
                <i class="fas fa-user-shield"></i>
                Gestionar Roles
            </a>
            
            <a href="{{ route('roles.create') }}">
                <i class="fas fa-plus-circle"></i>
                Crear Rol
            </a>
            
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-edit"></i>
                Editar mi perfil
            </a>
            
            <a href="{{ route('tickets.index') }}">
                <i class="fas fa-ticket-alt"></i>
                Mis Tickets
            </a>
            
            <a href="{{ route('tickets.create') }}">
                <i class="fas fa-plus"></i>
                Crear Ticket
            </a>
            
            <a href="{{ route('tickets.all') }}">
                <i class="fas fa-list"></i>
                Gestionar Todos los Tickets
            </a>
            
            <a href="{{ route('tickets.assign') }}">
                <i class="fas fa-tasks"></i>
                Asignar Tickets
            </a>
            
            <a href="{{ route('equipos.index') }}">
                <i class="fas fa-users-cog"></i>
                Gestionar Equipos
            </a>
            
            <a href="{{ route('reportes') }}">
                <i class="fas fa-chart-bar"></i>
                Reportes
            </a>
        </div>
    </div>
</body>
</html>