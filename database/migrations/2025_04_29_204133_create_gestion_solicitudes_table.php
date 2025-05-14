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
        Schema::create('gestion_solicitudes', function (Blueprint $table) {
            $table->increments('idGestion');
            $table->unsignedInteger('idSolicitud')->index('fk_gestion_solicitudes_solicitudes');
            $table->string('Cambios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_solicitudes');
    }
};
