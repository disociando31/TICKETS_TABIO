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
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign(['idEquipo'], 'FK_Tickets_Equipos')->references(['idEquipo'])->on('equipos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idGestor'], 'FK_Tickets_Gestores')->references(['idUsuario'])->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idUsuario'], 'FK_Tickets_Usuarios')->references(['idUsuario'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('FK_Tickets_Equipos');
            $table->dropForeign('FK_Tickets_Usuarios');
            $table->dropForeign('FK_Tickets_Gestores');
        });
    }
};
