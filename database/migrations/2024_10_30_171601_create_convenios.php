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
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');         // Nombre del convenio
            $table->string('instituto');      // Instituto asociado
            $table->text('descripcion');      // Descripción del convenio
            $table->string('ubicacion');      // Ubicación del convenio
            $table->date('fecha');            // Fecha del convenio
            $table->timestamps();             // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convenios');
    }
};
