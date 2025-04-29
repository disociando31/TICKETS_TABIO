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

        // Crear permisos para usuarios
        Permission::create(['name' => 'crear ticket']);
        Permission::create(['name' => 'ver ticket propio']);
        
        // Permisos para trabajadores
        Permission::create(['name' => 'recibir tickets']);
        Permission::create(['name' => 'gestionar tickets']);
        Permission::create(['name' => 'ver reportes']);
        
        // Permisos para administradores
        Permission::create(['name' => 'asignar tickets']);
        Permission::create(['name' => 'gestionar tickets']);
        Permission::create(['name' => 'generar reportes']);
        Permission::create(['name' => 'gestionar usuarios']);
        Permission::create(['name' => 'gestionar roles']);
        Permission::create(['name' => 'ver todos los tickets']);
        
        // Actualizar cache para conocer los permisos recién creados
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear roles y asignar permisos creados

        // Rol Usuario (básico)
        $rolUsuario = Role::create(['name' => 'Usuario']);
        $rolUsuario->givePermissionTo([
            'crear ticket', 
            'ver ticket propio'
        ]);

        // Rol Trabajador (soporte técnico)
        $rolTrabajador = Role::create(['name' => 'Trabajador']);
        $rolTrabajador->givePermissionTo([
            'recibir tickets',
            'solucionar tickets',
            'ver reportes',
            'ver ticket propio'
        ]);

        // Rol Administrador (acceso completo)
        $rolAdmin = Role::create(['name' => 'Administrador']);
        $rolAdmin->givePermissionTo(Permission::all());
    }
}