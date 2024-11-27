<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    // Definir los atributos que se pueden asignar masivamente
    protected $fillable = [
        'id_grupo',
        'fecha',
        'estado',
        'nombre_estudiante', // Añadir el atributo 'nombre_estudiante'
    ];

    /**
     * Definir la relación con el modelo Grupo.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
}
