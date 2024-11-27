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
        Schema::create('niveles', function (Blueprint $table) {
            $table->id(); // Campo id, tipo BIGINT
            $table->unsignedBigInteger('ididioma'); // Campo ididioma, tipo BIGINT sin signo
            $table->string('nombre_idioma'); // Campo nombre_idioma, tipo VARCHAR
            $table->string('descripcion'); // Campo descripcion, tipo VARCHAR
            $table->string('habilitado')->default('true'); // Campo habilitado, tipo STRING, por defecto 'true'
            $table->timestamps();

            // Agregar la clave foránea que referencia a la tabla idiomas
            $table->foreign('ididioma')->references('id')->on('idiomas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveles');
    }
};
