<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Materia; 
use App\Models\Clase; 
use App\Models\Asistencia; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    public function dashboard(){
        return view('estudiante.dashboard');
    }

    public function ver_asistencias(){
        return view('estudiante.asistencias');
    }

    public function mis_clases(){
        $userId = Auth::user()->id;

        $clasesDeEstudiante = DB::table('users as u')
            ->join('asistencia as a', 'u.id', '=', 'a.user_id')
            ->join('clase as c', 'a.clase_id', '=', 'c.id')
            ->join('materia as m', 'c.materia_id', '=', 'm.id')
            ->join('grupo as g', 'c.id_grupo', '=', 'g.id')
            ->join('aula as al', 'c.id_aula', '=', 'al.id')
            ->where('u.id', $userId)
            ->select(
                'c.id',
                'm.nombre as materia',
                'c.dia',
                'c.hora_inicio',
                'c.hora_fin',
                'g.nombre as grupo',
                'al.nombre as aula',
                DB::raw(
                    "CONCAT(m.nombre, ', ', c.dia, ', ', c.hora_inicio, ' - ', c.hora_fin, ', Aula: ', al.nombre, ', Grupo: ', g.nombre) as claseInfo"
                )
            )
            ->distinct()
            ->get();

        //dd($clasesDeEstudiante);

        return view('estudiante.asistencias', ['clases' => $clasesDeEstudiante]);


       
    }


    
}
