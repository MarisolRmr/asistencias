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

        return view('estudiante.misclases', ['clases' => $clasesDeEstudiante]);
       
    }

    public function info_clase(){
        $userId = Auth::id();

        $claseSeleccionada = request('clase');
        
        $clases = DB::table('clase as c')
            ->join('materia as m', 'c.materia_id', '=', 'm.id')
            ->join('grupo as g', 'c.id_grupo', '=', 'g.id')
            ->join('aula as a', 'c.id_aula', '=', 'a.id')
            ->join('users as u', 'c.user_id', '=', 'u.id') 
            ->where('c.id', $claseSeleccionada)
            ->select(
                'c.id',
                'm.nombre as materia',
                'c.dia',
                'c.hora_inicio',
                'c.hora_fin',
                'g.nombre as grupo',
                'a.nombre as aula',
                'u.name as nombre_del_profesor'
            )
            ->get();
        
        // Recuperar las asistencias de los estudiantes en la clase seleccionada
        $asistencias = Asistencia::join('users', 'asistencia.user_id', '=', 'users.id')
            ->where('asistencia.user_id', $userId) // Filtra por el ID del usuario autenticado
            ->where('asistencia.clase_id', $claseSeleccionada)
            ->select('users.id', 'users.name', 'asistencia.asistencia', 'asistencia.fecha')
            ->get();

        // Recuperar las asistencias de los estudiantes en la clase seleccionada
        $grafica = Asistencia::join('users', 'asistencia.user_id', '=', 'users.id')
            ->where('asistencia.clase_id', $claseSeleccionada)
            ->where('asistencia.asistencia', 1)
            ->where('users.id',$userId )
            ->select('users.id', 'users.name', DB::raw('COUNT(asistencia.id) as total_asistencias'))
            ->groupBy('users.id', 'users.name')
            ->get();

        return view('estudiante.asistencias', compact('clases', 'asistencias', 'grafica'));
    }


    
}
