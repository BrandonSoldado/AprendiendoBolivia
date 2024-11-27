<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;

    protected $table = 'idiomas';

    protected $fillable = ['nombre'];

    public function niveles()
    {
        return $this->hasMany(Nivel::class, 'ididioma'); // Asegúrate de que 'ididioma' es la clave foránea
    }
}

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'niveles';

    protected $fillable = [
        'ididioma',      // ID del idioma
        'nombre_idioma', // Nombre del idioma
        'descripcion',   // Descripción del nivel
        'habilitado',    // Estado del nivel
    ];

    public function idioma()
    {
        return $this->belongsTo(Idioma::class, 'ididioma');
    }
    public function niveles()
{
    return $this->hasMany(Nivel::class);
}

}
