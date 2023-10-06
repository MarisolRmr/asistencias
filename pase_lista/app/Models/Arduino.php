<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arduino extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'username',
        'password',
        'codigo_tarjeta',
        
    ];
    public function clases()
    {
        return $this->hasMany(Clase::class);
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

}
