<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dependencia;

class DependenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear dependencias de prueba
        $dependencias = [
            [
                'Dependencia' => 'Prueba',
                'Estado' => 'A'
            ]
        ];

        foreach ($dependencias as $dependencia) {
            Dependencia::create($dependencia);
        }
    }
}