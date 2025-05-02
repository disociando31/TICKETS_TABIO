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
        Schema::create('config_red', function (Blueprint $table) {
            $table->integer('idConfigRed', true);
            $table->integer('idEquipo')->index('fk_configred_equipos');
            $table->string('MAC');
            $table->string('IP');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_red');
    }
};
