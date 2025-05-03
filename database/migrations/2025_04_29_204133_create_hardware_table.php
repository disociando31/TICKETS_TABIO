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
        Schema::create('hardware', function (Blueprint $table) {
            $table->increments('idHardware');
            $table->unsignedInteger('idEquipo')->index('fk_hardware_equipos');
            $table->string('NumeroPlaca');
            $table->string('ModeloCPU');
            $table->string('SerialCPU');
            $table->string('Procesador');
            $table->string('RAM');
            $table->string('HDD');
            $table->string('Monitor');
            $table->string('SerialMonitor');
            $table->string('Teclado');
            $table->string('SerialTeclado');
            $table->string('Mouse');
            $table->string('SerialMouse');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware');
    }
};
