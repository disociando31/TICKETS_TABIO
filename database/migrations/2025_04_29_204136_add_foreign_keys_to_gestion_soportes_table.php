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
        Schema::table('gestion_soportes', function (Blueprint $table) {
            $table->foreign(['idSoporte'], 'FK_Gestion_Soportes_Soportes')->references(['idSoporte'])->on('soportes')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idUsuario'], 'FK_Gestion_Soportes_Usuarios')->references(['idUsuario'])->on('usuarios')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gestion_soportes', function (Blueprint $table) {
            $table->dropForeign('FK_Gestion_Soportes_Soportes');
            $table->dropForeign('FK_Gestion_Soportes_Usuarios');
        });
    }
};
