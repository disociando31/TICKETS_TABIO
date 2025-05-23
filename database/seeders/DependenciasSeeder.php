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
        $dependencias = [
            'SECRETARÍA',
            'DESPACHO',
            'PUNTO VIVE DIGITAL',
            'SECRETARÍA DE AMBIENTE',
            'SECRETARÍA DE TURISMO',
            'TECNOLOGÍA',
            'SECRETARÍA DE GOBIERNO',
            'SECRETARÍA GENERAL',
            'SECRETARÍA DE HACIENDA',
            'SECRETARÍA DE INFRAESTRUCTURA',
            'SECRETARÍA DE INTEGRACIÓN SOCIAL',
            'SECRETARÍA DE PLANEACIÓN',
            'No Asignado' // Se añade una dependencia para los equipos sin secretaria especificada
        ];

        foreach ($dependencias as $nombreDependencia) {
            Dependencia::firstOrCreate(
                ['Dependencia' => $nombreDependencia],
                ['Estado' => 'A'] // Asumiendo un estado activo por defecto
            );
        }
    }
}