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
            $table->enum('Prioridad', ['Prioritario', 'Urgente', 'Regular']);
            $table->enum('Tipo', ['Solicitud de servicio', 'Soporte']);
            $table->string('Descripcion');
            $table->date('FechaCreacion');
            $table->date('FechaCierre')->nullable();
            $table->unsignedInteger('idGestor')->nullable()->index('fk_tickets_gestores');

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
