<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('codigos', function (Blueprint $table) {
            $table->id(); // Campo 'id' auto-incremental
            $table->text('codigo_qr'); // Usar 'text' en lugar de 'string' para una cadena larga
            $table->decimal('monto_dinero', 10, 2); // Para almacenar montos con dos decimales
            $table->string('descripcion'); // Descripción (puedes usar 'text' si esperas cadenas más largas)
            $table->timestamps(); // Para las fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigos');
    }
};
