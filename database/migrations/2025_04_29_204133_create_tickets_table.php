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
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('idTicket');
            $table->enum('Estado', ['Abierto', 'Cerrado']);
            $table->unsignedInteger('idUsuario')->index('fk_tickets_usuarios');
            $table->enum('Prioridad', ['prioritario', 'urgente', 'regular']);
            $table->enum('Tipo', ['servicio', 'soporte']);
            $table->unsignedInteger('idEquipo')->nullable()->index('fk_tickets_equipos');
            $table->string('Descripcion');
            $table->date('FechaCreacion');
            $table->date('FechaCierre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
