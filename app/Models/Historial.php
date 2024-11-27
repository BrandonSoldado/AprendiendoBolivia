<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
        // Los atributos que pueden ser asignados masivamente
     
    // Definir el nombre correcto de la tabla en la base de datos
    protected $table = 'historiales';  // Aquí debe ser 'historiales', no 'historials'

    protected $fillable = [
        'modalidad_aprobacion',
        'nota',
        'modulo',
        'nombre_estudiante',
    ];
}
