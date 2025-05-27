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
            $table->string('NumeroPlaca')->nullable();
            $table->string('ModeloCPU');
            $table->string('SerialCPU');
            $table->string('Procesador');
            $table->string('RAM');
            $table->string('HDD');
            $table->string('Monitor')->nullable();
            $table->string('SerialMonitor')->nullable();
            $table->string('Teclado')->nullable();
            $table->string('SerialTeclado')->nullable();
            $table->string('Mouse')->nullable();
            $table->string('SerialMouse')->nullable()
            ;
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
