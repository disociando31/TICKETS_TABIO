<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gestion_tickets', function (Blueprint $table) {
            $table->increments('idGestion');
            $table->unsignedInteger('idTicket')->constrained('tickets', 'idTicket')->onDelete('cascade');
            $table->text('Cambios');
            $table->timestamps();
        });
        
        // Migrar datos existentes de gestion_soportes
        if (Schema::hasTable('gestion_soportes')) {
            $this->migrarGestionesDeSoportes();
        }
        
        // Migrar datos existentes de gestion_solicitudes
        if (Schema::hasTable('gestion_solicitudes')) {
            $this->migrarGestionesDeSolicitudes();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_tickets');
    }
    
    /**
     * Migra datos de gestion_soportes a gestion_tickets
     */
    private function migrarGestionesDeSoportes(): void
    {
        $sql = "
            INSERT INTO gestion_tickets (idTicket, Cambios, created_at, updated_at)
            SELECT t.idTicket, gs.Cambios, 
                   COALESCE(gs.created_at, NOW()), COALESCE(gs.updated_at, NOW())
            FROM gestion_soportes gs
            JOIN soportes s ON gs.idSoporte = s.idSoporte
            JOIN tickets t ON s.idTicket = t.idTicket
        ";
        DB::statement($sql);
    }
    
    /**
     * Migra datos de gestion_solicitudes a gestion_tickets
     */
    private function migrarGestionesDeSolicitudes(): void
    {
        $sql = "
            INSERT INTO gestion_tickets (idTicket, Cambios, created_at, updated_at)
            SELECT t.idTicket, gs.Cambios, 
                   COALESCE(gs.created_at, NOW()), COALESCE(gs.updated_at, NOW())
            FROM gestion_solicitudes gs
            JOIN solicitudes s ON gs.idSolicitud = s.idSolicitud
            JOIN tickets t ON s.idTicket = t.idTicket
        ";
        DB::statement($sql);
    }
};