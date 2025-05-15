<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;
use App\Models\ConfigRed;
use App\Models\Hardware;
use App\Models\SoftwareInstalado;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        $equipo = Equipo::create([
            'NombreEquipo' => 'Equipo prueba',
            'idDependencia' => 1, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'CPU',
            'NumeroPlaca' => '987654321',
            'ModeloCPU' => 'i7-9700K',
            'SerialCPU' => 'ABC123456',
            'Procesador' => 'Intel Core i7',
            'RAM' => '16GB',
            'HDD' => '1TB',
            'Monitor' => 'Dell 24"',
            'SerialMonitor' => 'MON123456',
            'Teclado' => 'Logitech K120',
            'SerialTeclado' => 'KEY123456',
            'Mouse' => 'Logitech M100',
            'SerialMouse' => 'MOU123456',
        ]);

        $equipo->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);
    }
}
