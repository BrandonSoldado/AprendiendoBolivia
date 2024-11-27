<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    // Specify the table associated with the model (optional if it follows Laravel's naming convention)
    protected $table = 'grupos';

    // Specify the fillable attributes
    protected $fillable = [
        'nombre',
        'estado',
        'nombre_docente',
        'idioma',
        'fecha_creacion',
    ];
     // Relación con parciales
     public function parciales()
     {
         return $this->hasMany(Parcial::class, 'id_grupo');
     }
 
     // Relación con asistencias
     public function asistencias()
     {
         return $this->hasMany(Asistencia::class, 'id_grupo');
     }
 
     // Relación con tareas
     public function tareas()
     {
         return $this->hasMany(Tarea::class, 'id_grupo');
     }

}
