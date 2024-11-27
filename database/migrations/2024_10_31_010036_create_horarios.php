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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID (Primary key)
            $table->string('dia'); // Día de la semana
            $table->time('hora'); // Hora del horario
            $table->string('aula'); // Aula asignada
            $table->foreignId('idgrupo')->constrained('grupos')->onDelete('cascade'); // Clave foránea referenciando a grupos
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
