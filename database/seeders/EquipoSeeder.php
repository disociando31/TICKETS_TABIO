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
            'ModeloCPU' => 'i7-9700K',
            'NumeroPlaca' => '987654321',
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

         $equipo1 = Equipo::create([
            'NombreEquipo' => 'desktop-3rm0j31',
            'idDependencia' => 1, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo1->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo1->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'N56JRH',
            'NumeroPlaca' => null,
            'SerialCPU' => 'E6N0BC11298124A',
            'Procesador' => 'Intel Core i7',
            'RAM' => '16 GB',
            'HDD' => '447,13 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo1->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo2 = Equipo::create([
            'NombreEquipo' => 'desktop-bjopkt9',
            'idDependencia' => 1, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo2->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo2->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProDesk 600 G1 TWR',
            'NumeroPlaca' => null,
            'SerialCPU' => 'MXL4242M0C',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '465,76 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo2->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

        $equipo3 = Equipo::create([
            'NombreEquipo' => 'desktop-cimubva',
            'idDependencia' => 1, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo3->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo3->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'OptiPlex SFF Plus 7010',
            'NumeroPlaca' => null,
            'SerialCPU' => 'H739G24',
            'Procesador' => 'Intel Core i7',
            'RAM' => '16 GB',
            'HDD' => '1 408,45 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo3->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo4 = Equipo::create([
            'NombreEquipo' => 'despacho-asesordesp',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo4->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo4->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP EliteDesk 700 G1 SFF',
            'NumeroPlaca' => null,
            'SerialCPU' => 'MXL5242MQ5',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '1 378,64 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo4->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo5 = Equipo::create([
            'NombreEquipo' => 'despacho-tics',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo5->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo5->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'OptiPlex 5400 AIO',
            'NumeroPlaca' => null,
            'SerialCPU' => 'H6N58V3',
            'Procesador' => 'Intel Core i7',
            'RAM' => '8 GB',
            'HDD' => '476,94 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo5->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);
        
        $equipo6 = Equipo::create([
            'NombreEquipo' => 'desp-alcalde',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo6->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo6->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 455 G4',
            'NumeroPlaca' => null,
            'SerialCPU' => '5CD7495QY0',
            'Procesador' => 'Intel Core i7',
            'RAM' => '8 GB',
            'HDD' => '223,57 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo6->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

        $equipo7 = Equipo::create([
            'NombreEquipo' => 'desp-ctrlinterno',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo7->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo7->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProDesk 400 G1 SFF',
            'NumeroPlaca' => null,
            'SerialCPU' => 'MXL4492KRJ',
            'Procesador' => 'Intel Core i7',
            'RAM' => '8 GB',
            'HDD' => '1 169,98 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo7->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);
        $equipo8 = Equipo::create([
            'NombreEquipo' => 'desp-jefeprensa',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo8->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo8->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProOne 400 G4 20.0-in NT AiO',
            'NumeroPlaca' => null,
            'SerialCPU' => '8CG9480BJB',
            'Procesador' => 'Intel Core i7',
            'RAM' => '8 GB',
            'HDD' => '253,11 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo8->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);
        $equipo9 = Equipo::create([
            'NombreEquipo' => 'desp-portsrere',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo9->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo9->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'Satellite S855',
            'NumeroPlaca' => null,
            'SerialCPU' => '2D321435Q',
            'Procesador' => 'Intel Core i7',
            'RAM' => '6 GB',
            'HDD' => '447,13 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo9->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

        $equipo10 = Equipo::create([
            'NombreEquipo' => 'desp-secejecutiva',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo10->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo10->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP Compaq Elite 8300 CMT',
            'NumeroPlaca' => null,
            'SerialCPU' => 'MXL30903K4',
            'Procesador' => 'Intel Core i7',
            'RAM' => '8 GB',
            'HDD' => '1 378,64 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo10->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

        $equipo11 = Equipo::create([
            'NombreEquipo' => 'prensa_diseno',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo11->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo11->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => '30DJS44N00',
            'NumeroPlaca' => null,
            'SerialCPU' => 'MJ0DXGZS',
            'Procesador' => 'Intel Core i7',
            'RAM' => '8 GB',
            'HDD' => '1 184,63 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo11->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

        $equipo12 = Equipo::create([
            'NombreEquipo' => 'prensa_fotograf',
            'idDependencia' => 2, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo12->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo12->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => '30DJS44N00',
            'NumeroPlaca' => null,
            'SerialCPU' => 'MJ0DXGZR',
            'Procesador' => 'Intel Core i7',
            'RAM' => '8 GB',
            'HDD' => '4 895,97 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo12->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

        $equipo13 = Equipo::create([
            'NombreEquipo' => 'captabio06',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo13->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo13->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE40718GN',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '465,76 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo13->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo14 = Equipo::create([
            'NombreEquipo' => 'pvd-0',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo14->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo14->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP 240 G8 Notebook PC',
            'NumeroPlaca' => null,
            'SerialCPU' => '5CG1462Z04',
            'Procesador' => 'Intel Core i7',
            'RAM' => '16 GB',
            'HDD' => '931,51 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo14->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo15 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-001',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo15->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo15->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE4071B07',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo15->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo16 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-02',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo16->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo16->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE4060LYB',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo16->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo17 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-03',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo17->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo17->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE40718G1',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '465,76 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo17->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo18 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-04',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo18->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo18->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE40718D9',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo18->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo19 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-05',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo19->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo19->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE4060LXK',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo19->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo20 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-06',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo20->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo20->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE4060LZC',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo20->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo21 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-07',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo21->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo21->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE407188T',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo21->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo22 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-08',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo22->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo22->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE4060M1K',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo22->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo23 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-09',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo23->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo23->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE40719P5',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '238,47 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo23->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo24 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-10',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo24->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo24->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP Laptop 14-cm0xxx',
            'NumeroPlaca' => null,
            'SerialCPU' => '5CG9185NKF',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '58,24 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo24->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);

         $equipo25 = Equipo::create([
            'NombreEquipo' => 'pvdtabio-11',
            'idDependencia' => 3, // Asegúrate de que este ID exista en la tabla dependencias
            'FechaAdquisicion' => date('Y-m-d H:i:s'),
        ]);

        $equipo25->configRed()->create([
            'idEquipo' => $equipo->idEquipo,
            'MAC' => '00:1A:2B:3C:4D:5E',
            'IP' => '12345',
        ]);

        $equipo25->hardware()->create([
            'idEquipo' => $equipo->idEquipo,
            'ModeloCPU' => 'HP ProBook 450 G1',
            'NumeroPlaca' => null,
            'SerialCPU' => '2CE40719C3',
            'Procesador' => 'Intel Core i7',
            'RAM' => '4 GB',
            'HDD' => '465,76 GB',
            'Monitor' => null,
            'SerialMonitor' => null,
            'Teclado' => null,
            'SerialTeclado' => null,
            'Mouse' => null,
            'SerialMouse' => null,
        ]);

        $equipo25->software_instalados()->create([
            'idEquipo' => $equipo->idEquipo,
            'SistemaOperativo' => 'Windows 10',
            'LicSuiteOfimatica' => 'ABC123456',
            'Antivirus' => 'Norton',
            'LicAntivirus' => 'XYZ987654',
            'SuiteOfimatica' => 'Professional',
        ]);



    }


    

}
