<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// Migración para la tabla 'parciales'
public function up(): void
{
    Schema::create('parciales', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_grupo'); // Clave foránea que apunta a 'grupos'
        $table->decimal('nota', 5, 2); // Atributo 'nota' con precisión de hasta 5 dígitos y 2 decimales
        $table->string('tipo'); // Atributo 'tipo' que describe el tipo de parcial
        $table->date('fecha'); // Atributo 'fecha' para la fecha del parcial
        $table->string('nombre_estudiante'); // Atributo 'nombre_estudiante'
        $table->timestamps();

        // Definir la clave foránea y establecer la relación con 'grupos'
        $table->foreign('id_grupo')->references('id')->on('grupos')->onDelete('cascade');
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('parciales');
}
};
