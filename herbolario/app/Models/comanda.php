<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comanda extends Model
{
    use HasFactory;
    protected $table = 'comanda';
    protected $fillable = [
        'id_usuario',
        'precio_final',
        'id_direccion',
        'estado'
    ];
}
