<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    /**
     * Ejecuta los seeders de roles y permisos.
     *
     * @return void
     */
    public function run(): void
    {
        // Limpiar la caché de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- CREAR PERMISOS ---
        
        // Permisos de Usuario
        Permission::create(['name' => 'crear tickets']);
        Permission::create(['name' => 'ver tickets propios']);
        Permission::create(['name' => 'editar perfil propio']);
        
        // Permisos de Tickets
        Permission::create(['name' => 'ver todos los tickets']);
        Permission::create(['name' => 'responder tickets']);
        Permission::create(['name' => 'cambiar estado tickets']);
        Permission::create(['name' => 'asignar tickets']);
        Permission::create(['name' => 'gestionar tickets']);
        
        // Permisos de Equipos
        Permission::create(['name' => 'ver equipos']);
        Permission::create(['name' => 'crear equipos']);
        Permission::create(['name' => 'editar equipos']);
        Permission::create(['name' => 'eliminar equipos']);
        Permission::create(['name' => 'gestionar hojas de vida']);
        Permission::create(['name' => 'realizar mantenimientos']);
        
        // Permisos de Reportes
        Permission::create(['name' => 'ver reportes']);
        Permission::create(['name' => 'generar reportes']);
        Permission::create(['name' => 'exportar reportes']);
        
        // Permisos de Administración
        Permission::create(['name' => 'gestionar usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        Permission::create(['name' => 'gestionar roles']);
        Permission::create(['name' => 'crear roles']);
        Permission::create(['name' => 'editar roles']);
        Permission::create(['name' => 'desactivar roles']);
        
        // Actualizar la caché para conocer los permisos recién creados
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- CREAR ROLES Y ASIGNAR PERMISOS ---

        // Rol Usuario (básico)
        $rolUsuario = Role::create(['name' => 'Usuario']);
        $rolUsuario->givePermissionTo([
            'crear tickets', 
            'ver tickets propios',
            'editar perfil propio'
        ]);

        // Rol Trabajador (soporte técnico)
        $rolTrabajador = Role::create(['name' => 'Trabajador']);
        $rolTrabajador->givePermissionTo([
            // Permisos de usuario básico
            'crear tickets',
            'ver tickets propios',
            'editar perfil propio',
            // Permisos específicos de trabajador
            'ver todos los tickets',
            'responder tickets',
            'cambiar estado tickets',
            // Permisos de equipos
            'ver equipos',
            'crear equipos',
            'editar equipos',
            'gestionar hojas de vida',
            'realizar mantenimientos',
            // Reportes básicos
            'ver reportes'
        ]);

        // Rol Administrador (acceso completo)
        $rolAdmin = Role::create(['name' => 'Administrador']);
        $rolAdmin->givePermissionTo(Permission::all());
    }
}