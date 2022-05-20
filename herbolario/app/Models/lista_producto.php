<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lista_producto extends Model
{
    use HasFactory;
    protected $table = 'lista_producto';
    protected $fillable = [
        'id_usuario',
        'id_producto',
        'id_comanda',
        'finalizado',
        'cantidad'
    ];
}
