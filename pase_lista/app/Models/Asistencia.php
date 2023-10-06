<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencia';
    protected $fillable = [
        'id',
        'clase_id',
        'fecha',
        'asistencia',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(Arduino::class, 'user_id');
    }
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'clase_id');
    }
}
