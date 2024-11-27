<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenios extends Model
{
    use HasFactory;

    protected $table = 'convenios';

    protected $fillable = [
        'nombre',
        'instituto',
        'descripcion',
        'ubicacion',
        'fecha'
    ];
}