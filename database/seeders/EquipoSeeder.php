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
            'nombre' => 'Equipo de Prueba',
            'descripcion' => 'Equipo de pruebas funcionales',
        ]);

        $equipo->configRed()->create([
            'ip' => '192.168.0.101',
            'mac' => '00:1B:44:11:3A:B7',
        ]);

        $equipo->hardware()->create([
            'procesador' => 'Intel Core i5',
            'ram' => '8 GB',
            'disco' => '500 GB SSD',
        ]);

        $equipo->softwareInstalado()->create([
            'sistema_operativo' => 'Windows 10',
            'programas' => 'Office, Chrome, VS Code',
        ]);
    }
}
