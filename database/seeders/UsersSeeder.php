<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario Administrador
        $admin = User::create([
            'nombre' => 'Administrador',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'telefono' => '3001234567',
            'idDependencia' => 1, // Asegúrate de que este ID exista en la tabla dependencias
        ]);

        // Asignar rol de Administrador
        $admin->assignRole('Administrador');

        // Crear usuario Trabajador
        $trabajador = User::create([
            'nombre' => 'Trabajador',
            'username' => 'trabajador',
            'password' => Hash::make('trabajador123'),
            'telefono' => '3007654321',
            'idDependencia' => 1, // Asegúrate de que este ID exista en la tabla dependencias
        ]);

        // Asignar rol de Trabajador
        $trabajador->assignRole('Trabajador');

        // Crear usuario básico
        $usuario = User::create([
            'nombre' => 'Usuario',
            'username' => 'usuario',
            'password' => Hash::make('usuario123'),
            'telefono' => '3009876543',
            'idDependencia' => 1, // Asegúrate de que este ID exista en la tabla dependencias
        ]);


        // Asignar rol de Usuario
        $usuario->assignRole('Usuario');

    }
}
