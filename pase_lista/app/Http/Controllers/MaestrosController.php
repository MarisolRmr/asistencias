<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaestrosController extends Controller
{
    public function ver_clases(){
        return view('maestro.clases');
    }

    public function ver_horarios(){
        return view('maestro.horarios');
    }

    public function seleccionar_asistencias(){
        return view('maestro.editarAsistencias.asistencias');
    }

    public function editar_asistencias(){
        return view('maestro.editarAsistencias.editar');
    }
}
