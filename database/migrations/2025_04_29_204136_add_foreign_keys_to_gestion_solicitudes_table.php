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
        Schema::table('gestion_solicitudes', function (Blueprint $table) {
            $table->foreign(['idSolicitud'], 'FK_Gestion_Solicitudes_Solicitudes')->references(['idSolicitud'])->on('solicitudes')->onUpdate('restrict')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gestion_solicitudes', function (Blueprint $table) {
            $table->dropForeign('FK_Gestion_Solicitudes_Solicitudes');
        });
    }
};
