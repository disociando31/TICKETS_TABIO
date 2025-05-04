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
        Schema::table('soportes', function (Blueprint $table) {
            $table->foreign(['idTicket'], 'FK_Soportes_Tickets')->references(['idTicket'])->on('tickets')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idTipoEquipo'], 'FK_Soportes_TiposEquipo')->references(['idTipoEquipo'])->on('tiposequipo')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idTipoMantenimiento'], 'FK_Soportes_TiposMantenimiento')->references(['idTipoMantenimiento'])->on('tiposmantenimiento')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idTipoSoporte'], 'FK_Soportes_Tipos_Soporte')->references(['idTipoSoporte'])->on('tipos_soporte')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soportes', function (Blueprint $table) {
            $table->dropForeign('FK_Soportes_Tickets');
            $table->dropForeign('FK_Soportes_TiposEquipo');
            $table->dropForeign('FK_Soportes_TiposMantenimiento');
            $table->dropForeign('FK_Soportes_Tipos_Soporte');
        });
    }
};
