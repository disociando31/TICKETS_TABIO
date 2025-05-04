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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('idUsuario');
            $table->unsignedInteger('idDependencia');
            $table->string('nombre', 255);
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('telefono', 255);
            $table->timestamps();

            $table->foreign('idDependencia')->references('idDependencia')->on('dependencias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};