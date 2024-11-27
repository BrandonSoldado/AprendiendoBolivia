<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla (opcional si sigue la convención)
    protected $table = 'bitacoras';

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'actividad',
        'nombre_usuario',
        'fecha',
        'hora',
        'rol_usuario',
    ];
}