<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('software_instalado', function (Blueprint $table) {
            $table->integer('idSoftwareInstalado', true);
            $table->integer('idEquipo')->index('fk_softwareinstalado_equipos');
            $table->string('SistemaOperativo');
            $table->string('LicSuiteOfimatica');
            $table->string('SuiteOfimatica');
            $table->string('LicAntivirus');
            $table->string('Antivirus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software_instalado');
    }
};
