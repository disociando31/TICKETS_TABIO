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
        Schema::table('config_red', function (Blueprint $table) {
            $table->foreign(['idEquipo'], 'FK_ConfigRed_Equipos')->references(['idEquipo'])->on('equipos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('config_red', function (Blueprint $table) {
            $table->dropForeign('FK_ConfigRed_Equipos');
        });
    }
};
