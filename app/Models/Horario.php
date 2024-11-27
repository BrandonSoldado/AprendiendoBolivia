<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    // Define la tabla si no sigue la convención plural
    protected $table = 'horarios';

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'dia',
        'hora',
        'aula',
        'idgrupo',
    ];

    // Define la relación con el modelo Grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idgrupo');
    }
}
