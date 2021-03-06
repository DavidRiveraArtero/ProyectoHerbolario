<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosProducto extends Model
{
    use HasFactory;
    //protected $table = 'fotos_productos';

    protected $fillable = [
        'id_product',
        'file_path',
        'activo'
    ];
}
