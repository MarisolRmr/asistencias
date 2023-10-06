<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arduino extends Model
{
    use HasFactory;
    protected $table = 'usuario';
    protected $fillable = [
        'username',
        'password',
        'codigo_tarjeta',
    ];
}
