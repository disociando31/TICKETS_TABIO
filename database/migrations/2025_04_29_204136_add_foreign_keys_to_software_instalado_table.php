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
        Schema::table('software_instalado', function (Blueprint $table) {
            $table->foreign(['idEquipo'], 'FK_SoftwareInstalado_Equipos')->references(['idEquipo'])->on('equipos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('software_instalado', function (Blueprint $table) {
            $table->dropForeign('FK_SoftwareInstalado_Equipos');
        });
    }
};
