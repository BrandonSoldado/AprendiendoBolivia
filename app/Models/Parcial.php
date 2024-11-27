<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcial extends Model
{
    use HasFactory;
    protected $table = 'parciales'; 

    // Definir los atributos que se pueden asignar masivamente
    protected $fillable = [
        'id_grupo',
        'nota',
        'tipo',
        'fecha',
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
