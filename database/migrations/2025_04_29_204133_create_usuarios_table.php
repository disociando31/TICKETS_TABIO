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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('idUsuario')->primary();
            $table->integer('idRol')->index('fk_personas_roles');
            $table->integer('idDependencia')->index('fk_personas_dependencias');
            $table->string('Nombre');
            $table->string('Username');
            $table->string('Password');
            $table->string('Telefono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
