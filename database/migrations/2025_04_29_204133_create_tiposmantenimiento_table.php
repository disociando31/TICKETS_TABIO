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
        Schema::create('tiposmantenimiento', function (Blueprint $table) {
            $table->increments('idTipoMantenimiento');
            $table->string('TipoMantenimiento');
            $table->char('Estado', 1)->default('A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiposmantenimiento');
    }
};
