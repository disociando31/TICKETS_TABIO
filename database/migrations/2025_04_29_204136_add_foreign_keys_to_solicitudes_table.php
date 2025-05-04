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
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->foreign(['idTicket'], 'FK_Solicitudes_Tickets')->references(['idTicket'])->on('tickets')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idTipoAsistencia'], 'FK_Solicitudes_TiposAsistencia')->references(['idTipoAsistencia'])->on('tiposasistencia')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign('FK_Solicitudes_Tickets');
            $table->dropForeign('FK_Solicitudes_TiposAsistencia');
        });
    }
};
