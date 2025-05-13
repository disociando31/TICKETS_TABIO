<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->integer('idSoporte')->primary();
            $table->integer('idTicket')->nullable()->index('fk_soportes_tickets');
            $table->enum('TipoEquipo', ['Impresora', 'Scanner', 'Monitor', 'CPU', 'Otro']);
            $table->enum('TipoSoporte', ['Solicitud', 'Diagnostico', 'Baja', 'Otro']);
             $table->enum('TipoMantenimiento', ['Preventivo', 'Correctivo']);  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soportes');
    }
};
