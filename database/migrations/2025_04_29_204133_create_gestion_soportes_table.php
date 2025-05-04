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
        Schema::create('gestion_soportes', function (Blueprint $table) {
            $table->increments('idGestion');
            $table->unsignedInteger('idSoporte')->index('fk_gestion_soportes_soportes');
            $table->unsignedInteger('idUsuario')->index('fk_gestion_soportes_usuarios');
            $table->string('Cambios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_soportes');
    }
};
