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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreign(['idDependencia'], 'FK_Personas_Dependencias')->references(['idDependencia'])->on('dependencias')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['idRol'], 'FK_Personas_Roles')->references(['idRol'])->on('roles')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('FK_Personas_Dependencias');
            $table->dropForeign('FK_Personas_Roles');
        });
    }
};
