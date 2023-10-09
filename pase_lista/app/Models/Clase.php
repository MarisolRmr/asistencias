<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;
    protected $table = 'clase';
    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'dia',
        'user_id',
        'id_grupo',
        'materia_id',
        'estado',
        'id_aula'
    ];
    public function user()
    {
        return $this->belongsTo(Arduino::class, 'user_id');
    }
    public function profe()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
    public function asistencias()
    {
        return $this->belongsTo(Asistencia::class, 'materia_id');
    }
    public function grupos()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }
   
}
