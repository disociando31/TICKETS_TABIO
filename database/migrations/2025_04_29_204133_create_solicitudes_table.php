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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->integer('idSolicitud')->primary();
            $table->integer('idTicket')->index('fk_solicitudes_tickets');
            $table->integer('idTipoAsistencia')->index('fk_solicitudes_tiposasistencia');
            $table->string('Aplicacion');
            $table->string('ElementosAfectados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
