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
        Schema::create('tiposasistencia', function (Blueprint $table) {
            $table->integer('idTipoAsistencia')->primary();
            $table->string('TipoAsistencia');
            $table->char('Estado', 1)->default('A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiposasistencia');
    }
};
