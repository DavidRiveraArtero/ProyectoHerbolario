<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direccione extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_usuario',
        'pais',
        'telefono',
        'linea_direccion',
        'codigo_postal',
        'ciudad',
        'provincia',
        'nombre'
    ];
}
