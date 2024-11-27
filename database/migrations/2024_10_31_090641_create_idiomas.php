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
    Schema::create('idiomas', function (Blueprint $table) {
        $table->id(); // Crea el campo id (clave primaria)
        $table->string('nombre'); // Crea el campo nombre (de tipo string)
        $table->timestamps(); // Crea los campos created_at y updated_at
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('idiomas');
}
};
