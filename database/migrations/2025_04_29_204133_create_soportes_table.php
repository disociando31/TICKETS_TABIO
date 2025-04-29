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
        Schema::create('soportes', function (Blueprint $table) {
            $table->integer('idSoporte')->primary();
            $table->integer('idTicket')->nullable()->index('fk_soportes_tickets');
            $table->integer('idTipoEquipo')->index('fk_soportes_tiposequipo');
            $table->integer('idTipoSoporte')->index('fk_soportes_tipos_soporte');
            $table->integer('idTipoMantenimiento')->index('fk_soportes_tiposmantenimiento');
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
