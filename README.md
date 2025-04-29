# Sistema de Gestión de Roles y Usuarios

Este módulo implementa la gestión de usuarios, roles y permisos para el sistema de tickets de soporte técnico. Utiliza Laravel UI para la autenticación y Spatie Permission para el manejo de roles y permisos.

## Características Implementadas

- Login y registro de usuarios
- Gestión de roles (Administrador, Trabajador, Usuario)
- Permisos basados en roles
- CRUD completo de usuarios
- Dashboard básico que muestra opciones según el rol del usuario
- Generación automática de nombres de usuario

## Instalación y Configuración

### 1. Instalar dependencias

```bash
composer require laravel/ui
composer require spatie/laravel-permission
```

### 2. Publicar y ejecutar migraciones de Spatie

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

### 3. Ejecutar seeders para crear roles y permisos

```bash
php artisan db:seed --class=RolesYPermisosSeeder
```

### 4. Configurar el idioma español (opcional)

Para tener todos los mensajes en español:

```bash
composer require laraveles/spanish
php artisan vendor:publish --tag=lang
```

Modificar `config/app.php`:
```php
'locale' => 'es',
```

## Estructura de Roles y Permisos

### Roles Predefinidos

- **Usuario**: Rol básico para usuarios regulares
- **Trabajador**: Personal de soporte técnico
- **Administrador**: Acceso completo al sistema

### Permisos

- **gestionar_perfil**: Ver y editar su propio perfil
- **gestionar_tickets_propios**: Crear y ver sus propios tickets
- **gestionar_todos_tickets**: Ver y modificar cualquier ticket
- **asignar_tickets**: Asignar tickets a trabajadores
- **gestionar_equipos**: CRUD de equipos
- **gestionar_mantenimientos**: CRUD de mantenimientos
- **gestionar_reportes**: Ver, generar y exportar reportes
- **gestionar_usuarios**: CRUD de usuarios
- **gestionar_roles**: CRUD de roles

## Creación de Usuarios con Tinker

Para crear usuarios rápidamente con roles específicos usando Tinker:

```bash
php artisan tinker
```

### Crear un usuario administrador

```php
$admin = new App\Models\User();
$admin->nombre = 'Administrador';
$admin->username = 'admin';
$admin->password = Hash::make('password');
$admin->telefono = '123456789';
$admin->idDependencia = 1; // Asegúrate de que esta dependencia exista
$admin->save();
$admin->assignRole('Administrador');
```

### Crear un trabajador

```php
$trabajador = new App\Models\User();
$trabajador->nombre = 'Técnico Soporte';
$trabajador->username = 'soporte';
$trabajador->password = Hash::make('password');
$trabajador->telefono = '987654321';
$trabajador->idDependencia = 1;
$trabajador->save();
$trabajador->assignRole('Trabajador');
```

### Crear un usuario regular

```php
$usuario = new App\Models\User();
$usuario->nombre = 'Usuario Regular';
$usuario->username = 'usuario';
$usuario->password = Hash::make('password');
$usuario->telefono = '555444333';
$usuario->idDependencia = 2; // Otra dependencia
$usuario->save();
$usuario->assignRole('Usuario');
```

## Uso de las Vistas Básicas para Pruebas

### Dashboard

- URL: `/dashboard` o `/`
- Muestra opciones según el rol del usuario

### Gestión de Usuarios (Solo Admin)

- Listado: `/usuarios`
- Crear: `/usuarios/create`
- Ver detalles: `/usuarios/{id}`
- Editar: `/usuarios/{id}/edit`

### Perfil de Usuario

- Ver/Editar perfil: `/perfil`

## Verificación de Roles en el Código

### En controladores

```php
// Verificar roles
if ($user->hasRole('Administrador')) {
    // Lógica para administradores
}

// Verificar permisos
if ($user->hasPermissionTo('gestionar_usuarios')) {
    // Lógica para quien puede gestionar usuarios
}
```

### En vistas (Blade)

```blade
@role('Administrador')
    <!-- Contenido solo para administradores -->
@endrole

@can('gestionar_tickets')
    <!-- Contenido para usuarios con ese permiso -->
@endcan
```

### En rutas

```php
Route::middleware('role:Administrador')->group(function () {
    // Rutas solo para administradores
});

Route::middleware('permission:gestionar_usuarios')->group(function () {
    // Rutas para quienes pueden gestionar usuarios
});
```

## Personalización Adicional

### Modificar los permisos de un rol

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

$rol = Role::findByName('Trabajador');
$rol->givePermissionTo('nuevo_permiso');
$rol->revokePermissionTo('permiso_a_quitar');
```

### Crear un nuevo rol

```php
$rol = Role::create(['name' => 'Supervisor']);
$rol->givePermissionTo([
    'gestionar_tickets_propios',
    'gestionar_todos_tickets',
    'gestionar_reportes'
]);
```

## Troubleshooting

### Borrar caché de permisos

Si los cambios en permisos no se reflejan inmediatamente:

```bash
php artisan cache:forget spatie.permission.cache
```

### Regenerar toda la caché

```bash
php artisan optimize:clear
```

### Verificar roles asignados a un usuario

```bash
php artisan tinker
$user = App\Models\User::find(1);
$user->getRoleNames(); // Ver roles
$user->getAllPermissions(); // Ver permisos
```