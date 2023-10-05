<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function ver_asistencias(){
        return view('estudiante.asistencias');
    }
}
