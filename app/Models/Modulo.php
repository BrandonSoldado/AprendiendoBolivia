<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    // Especifica los campos que son asignables en masa
    protected $fillable = ['nombre', 'descripcion'];

}
