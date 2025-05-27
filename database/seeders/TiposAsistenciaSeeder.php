<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tiposasistencia;

class TiposAsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposAsistencia = [
            [
                'TipoAsistencia' => 'SOPORTE REMOTO',
                'Estado' => 'A'
            ],
            [
                'TipoAsistencia' => 'ASISTENCIA TÉCNICA',
                'Estado' => 'A'
            ]
        ];

        foreach ($tiposAsistencia as $tipo) {
            Tiposasistencia::firstOrCreate(
                ['TipoAsistencia' => $tipo['TipoAsistencia']], // Condición para buscar
                $tipo // Datos a insertar si no existe
            );
        }
    }
}