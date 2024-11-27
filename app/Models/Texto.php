<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texto extends Model
{
    use HasFactory;

    // Define la tabla asociada (opcional si sigue la convención)
    protected $table = 'textos';

    // Define los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'precio',
        'autor',
        'edicion',
        'id_nivel',
    ];

    // Define la relación con el modelo Nivel
    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel');
    }
}
