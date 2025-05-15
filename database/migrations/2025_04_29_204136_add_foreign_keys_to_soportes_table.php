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
            $table->foreign(['idEquipo'], 'FK_Soportes_Equipos')->references(['idEquipo'])->on('equipos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soportes', function (Blueprint $table) {
            $table->dropForeign('FK_Soportes_Tickets');
            $table->dropForeign('FK_Soportes_Equipos');
        });
    }
};
