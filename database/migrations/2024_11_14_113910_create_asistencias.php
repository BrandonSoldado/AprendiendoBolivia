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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();  // Clave primaria
            $table->unsignedBigInteger('id_grupo'); // Clave foránea que apunta a 'grupos'
            $table->date('fecha');  // Atributo 'fecha', tipo DATE
            $table->string('estado');  // Atributo 'estado', tipo STRING
            $table->string('nombre_estudiante'); // Atributo 'nombre_estudiante'
            $table->timestamps();  // Timestamps para 'created_at' y 'updated_at'
    
            // Definir la clave foránea y establecer la relación con 'grupos'
            $table->foreign('id_grupo')->references('id')->on('grupos')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
