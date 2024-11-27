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
        Schema::create('modulos', function (Blueprint $table) {
            $table->id(); // Columna ID
            $table->string('nombre'); // Columna para el nombre del módulo
            $table->text('descripcion'); // Columna para la descripción del módulo
            $table->timestamps(); // Columna para las marcas de tiempo (created_at y updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
