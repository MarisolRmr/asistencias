<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupo';
    protected $fillable = [
        'nombre',
    ];
    public function clase()
    {
        return $this->belongsToMany(Clase::class, 'clase_id');
    }
    
}
