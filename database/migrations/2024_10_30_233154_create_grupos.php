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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID (Primary key)
            $table->string('nombre'); // Group name
            $table->string('estado')->default(true); // Status (active/inactive)
            $table->string('nombre_docente'); // Docent name
            $table->string('idioma'); // Language
            $table->date('fecha_creacion'); // Creation date
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
