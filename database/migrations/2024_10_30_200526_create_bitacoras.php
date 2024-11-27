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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('actividad'); // Columna para la actividad
            $table->string('nombre_usuario'); // Columna para el nombre de usuario
            $table->date('fecha'); // Columna para la fecha
            $table->time('hora'); // Columna para la hora
            $table->char('rol_usuario'); // Columna para el rol del usuario
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};