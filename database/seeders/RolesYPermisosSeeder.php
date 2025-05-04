<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Usamos nuestro modelo personalizado en lugar del de Spatie
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar revisión de claves foráneas
        Schema::disableForeignKeyConstraints();
        
        // Truncar las tablas para evitar duplicados
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        
        // Reactivar revisión de claves foráneas
        Schema::enableForeignKeyConstraints();

        // Limpiar cache roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- CREAR PERMISOS BÁSICOS ---
        
        // Permisos generales
        Permission::create(['name' => 'gestionar_perfil', 'guard_name' => 'web']); // Ver y editar su propio perfil
        
        // Permisos de tickets
        Permission::create(['name' => 'gestionar_tickets_propios', 'guard_name' => 'web']); // Crear y ver sus propios tickets
        Permission::create(['name' => 'gestionar_todos_tickets', 'guard_name' => 'web']); // Ver y modificar cualquier ticket
        Permission::create(['name' => 'asignar_tickets', 'guard_name' => 'web']); // Asignar tickets a trabajadores
        
        // Permisos de equipos
        Permission::create(['name' => 'gestionar_equipos', 'guard_name' => 'web']); // CRUD de equipos
        Permission::create(['name' => 'gestionar_mantenimientos', 'guard_name' => 'web']); // CRUD de mantenimientos
        
        // Permisos de reportes
        Permission::create(['name' => 'gestionar_reportes', 'guard_name' => 'web']); // Ver, generar y exportar reportes
        
        // Permisos de administración
        Permission::create(['name' => 'gestionar_usuarios', 'guard_name' => 'web']); // CRUD de usuarios
        Permission::create(['name' => 'gestionar_roles', 'guard_name' => 'web']); // CRUD de roles
        
        // Actualizar la caché
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- CREAR ROLES Y ASIGNAR PERMISOS ---

        // Rol Usuario (con estado activo)
        $rolUsuario = Role::create([
            'name' => 'Usuario', 
            'guard_name' => 'web',
            'estado' => true
        ]);
        
        $rolUsuario->givePermissionTo([
            'gestionar_perfil',
            'gestionar_tickets_propios'
        ]);

        // Rol Trabajador (con estado activo)
        $rolTrabajador = Role::create([
            'name' => 'Trabajador', 
            'guard_name' => 'web',
            'estado' => true
        ]);
        
        $rolTrabajador->givePermissionTo([
            'gestionar_perfil',
            'gestionar_tickets_propios',
            'gestionar_todos_tickets',
            'gestionar_equipos',
            'gestionar_mantenimientos'
        ]);

        // Rol Administrador (con estado activo)
        $rolAdmin = Role::create([
            'name' => 'Administrador', 
            'guard_name' => 'web',
            'estado' => true
        ]);
        
        $rolAdmin->givePermissionTo(Permission::all());
    }
}