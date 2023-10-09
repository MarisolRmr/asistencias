<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_Grupos extends Model
{
    use HasFactory;
    protected $table = 'users_grupos';
    protected $fillable = [
        'id',
        'user_id',
        'id_grupo'
    ];
    public function user()
    {
        return $this->belongsTo(Arduino::class, 'user_id');
    }
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'user_id'); // Cambia 'Arduino' a 'User'
    }
    
    
}
