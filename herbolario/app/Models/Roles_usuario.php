<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles_usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
}
