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
        Schema::create('textos', function (Blueprint $table) {
            $table->id(); // Campo id, tipo BIGINT
            $table->string('nombre'); // Campo nombre, tipo VARCHAR
            $table->decimal('precio', 10, 2); // Campo precio, tipo DECIMAL (10, 2)
            $table->string('autor'); // Campo autor, tipo VARCHAR
            $table->string('edicion'); // Campo edicion, tipo VARCHAR
            $table->unsignedBigInteger('id_nivel'); // Campo id_nivel, tipo BIGINT sin signo
            
            $table->timestamps();

            // Agregar la clave foránea que referencia a la tabla niveles
            $table->foreign('id_nivel')->references('id')->on('niveles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('textos');
    }
};
