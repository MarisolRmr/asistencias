<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;
    protected $table = 'clase';
    protected $fillable = [
        'id',
        'hora_inicio',
        'hora_fin',
        'salon',
        'dia',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(Arduino::class, 'user_id');
    }
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
    public function asistencias()
    {
        return $this->belongsTo(Asistencia::class, 'materia_id');
    }
   
}
