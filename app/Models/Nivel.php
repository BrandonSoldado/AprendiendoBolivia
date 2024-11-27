<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    protected $table = 'niveles';

    // Definir los atributos que se pueden asignar en masa
    protected $fillable = [
        'ididioma',      // ID del idioma
        'nombre_idioma', // Nombre del idioma
        'descripcion',   // Descripción del nivel
        'habilitado',    // Estado del nivel (habilitado o no)
    ];

    /**
     * Relación con el modelo Idioma.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function idioma()
    {
        return $this->belongsTo(Idioma::class, 'ididioma');
    }
    // Define la relación con el modelo Texto
    public function textos()
    {
        return $this->hasMany(Texto::class, 'id_nivel');
    }
    
    
}
