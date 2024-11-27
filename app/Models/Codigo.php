<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    use HasFactory;
    // Especifica los atributos que se pueden asignar masivamente
    protected $fillable = ['codigo_qr', 'monto_dinero', 'descripcion'];
}
