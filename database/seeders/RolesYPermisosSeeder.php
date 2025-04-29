<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar cache roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- CREAR PERMISOS BÁSICOS ---
        
        // Permisos generales
        Permission::create(['name' => 'gestionar_perfil']); // Ver y editar su propio perfil
        
        // Permisos de tickets
        Permission::create(['name' => 'gestionar_tickets_propios']); // Crear y ver sus propios tickets
        Permission::create(['name' => 'gestionar_todos_tickets']); // Ver y modificar cualquier ticket
        Permission::create(['name' => 'asignar_tickets']); // Asignar tickets a trabajadores
        
        // Permisos de equipos
        Permission::create(['name' => 'gestionar_equipos']); // CRUD de equipos
        Permission::create(['name' => 'gestionar_mantenimientos']); // CRUD de mantenimientos
        
        // Permisos de reportes
        Permission::create(['name' => 'gestionar_reportes']); // Ver, generar y exportar reportes
        
        // Permisos de administración
        Permission::create(['name' => 'gestionar_usuarios']); // CRUD de usuarios
        Permission::create(['name' => 'gestionar_roles']); // CRUD de roles
        
        // Actualizar la caché
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- CREAR ROLES Y ASIGNAR PERMISOS ---

        // Rol Usuario
        $rolUsuario = Role::create(['name' => 'Usuario']);
        $rolUsuario->givePermissionTo([
            'gestionar_perfil',
            'gestionar_tickets_propios'
        ]);

        // Rol Trabajador
        $rolTrabajador = Role::create(['name' => 'Trabajador']);
        $rolTrabajador->givePermissionTo([
            'gestionar_perfil',
            'gestionar_tickets_propios',
            'gestionar_todos_tickets',
            'gestionar_equipos',
            'gestionar_mantenimientos'
        ]);

        // Rol Administrador
        $rolAdmin = Role::create(['name' => 'Administrador']);
        $rolAdmin->givePermissionTo(Permission::all());
    }
}