<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Materia; 
use App\Models\Clase; 
use App\Models\Asistencia; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaestrosController extends Controller
{
    public function dashboard(){
        return view('maestro.dashboard');
    }

    public function mis_clases(){
        $userId = Auth::id();
    
        $materias = DB::table('users as u')
            ->join('clase as c', 'u.id', '=', 'c.user_id')
            ->join('materia as m', 'c.materia_id', '=', 'm.id')
            ->join('grupo as g', 'c.id_grupo', '=', 'g.id')
            ->join('aula as a', 'c.id_aula', '=', 'a.id')
            ->where('u.id', $userId)
            ->select(
                'c.id',
                'm.nombre as materia',
                'c.dia',
                'c.hora_inicio',
                'c.hora_fin',
                'g.nombre as grupo',
                'a.nombre as aula',
                DB::raw(
                    "CONCAT(m.nombre,', ', c.dia, ', ', c.hora_inicio, ' - ', c.hora_fin, ', Aula: ', a.nombre, ', Grupo: ', g.nombre) as claseInfo"
                )
            )
            ->get();

            

        return view('maestro.clases.misclases', compact('materias'));
    }

    public function fechas(Request $request){
        // Obtener la información de las clases para mostrarla en la vista del formulario

        $claseSeleccionada = request('selectedClass');
        //dd($claseSeleccionada);
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
    
        // Inicializar $fechasAsistencia como un arreglo vacío
        $fechasAsistencia = [];

        // Verificar si se ha enviado el formulario
        if ($request->isMethod('post')) {
            // Obtener las fechas de inicio y fin seleccionadas
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFin = $request->input('fecha_fin');

            // Verificar que las fechas sean válidas y tengan el formato correcto
            if ($fechaInicio && $fechaFin) {
                // Realizar acciones en función de las fechas seleccionadas
                // Por ejemplo, consultar la base de datos o realizar algún procesamiento

                // Ejemplo de obtención de datos (reemplaza esto con tu lógica real)
                $asistencias = Asistencia::join('users', 'asistencia.user_id', '=', 'users.id')
                    ->where('fecha', '>=', $fechaInicio)
                    ->where('fecha', '<=', $fechaFin)
                    ->where('asistencia.clase_id', $claseSeleccionada)
                    ->select('users.name',DB::raw('COUNT(asistencia.asistencia) as total_asistencias'))
                    ->groupBy('users.id', 'users.name')
                    ->get();
                //dd($asistencias);
                // Obtener las asistencias de los estudiantes en la clase seleccionada
                // $asistencias = Asistencia::join('users', 'asistencia.user_id', '=', 'users.id')
                //     ->where('asistencia.clase_id', $claseSeleccionada)
                //     ->where('asistencia.asistencia', 1)
                //     ->where('users.rol', 3)
                //     ->select('users.id', 'users.name', DB::raw('COUNT(asistencia.id) as total_asistencias'))
                //     ->groupBy('users.id', 'users.name')
                //     ->get();
                 // Obtener las fechas de asistencia de la base de datos
                    $fechasAsistencia = DB::table('asistencia')
                    ->where('clase_id', $claseSeleccionada)
                    ->distinct()
                    ->pluck('fecha');

                // Devolver una vista con los resultados y las variables $clases, $fechasAsistencia y $asistencias
                return view('maestro.clases.infoClase', compact( 'clases', 'fechasAsistencia', 'asistencias'));
            }
        }

        // Si no se ha enviado el formulario, simplemente carga la vista del formulario
        // Esto puede incluir la lógica para cargar las fechas iniciales en los selectores de fecha si es necesario
        // ...

        // Obtener las fechas de asistencia de la base de datos
        $fechasAsistencia = DB::table('asistencia')
            ->where('clase_id', $claseSeleccionada)
            ->distinct()
            ->pluck('fecha');

        // Mostrar las fechas obtenidas en la vista
        return view('maestro.clases.infoClase', compact('clases', 'fechasAsistencia'));
    }
    
    
    
    //maestro.clases.infoClase

    public function info_clase(){
        $claseSeleccionada = request('clase');
        
        // Obtener las fechas de asistencia de la base de datos
        $fechasAsistencia = DB::table('asistencia')
            ->where('clase_id', $claseSeleccionada)
            ->distinct()
            ->pluck('fecha');
    
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
            ->where('asistencia.clase_id', $claseSeleccionada)
            ->where('asistencia.asistencia', 1)
            ->where('users.rol', 3)
            ->select('users.id', 'users.name', DB::raw('COUNT(asistencia.id) as total_asistencias'))
            ->groupBy('users.id', 'users.name')
            ->get();
    
        return view('maestro.clases.infoClase', compact('clases', 'asistencias', 'fechasAsistencia'));
    }
    

    public function asistencias(Clase $clase){
        $claseSeleccionada = $clase->id;
    
        // Datos de la clase
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

    
        // fechas
        $fechasAsistencia = DB::table('asistencia')
            ->where('clase_id', $claseSeleccionada)
            ->distinct()
            ->pluck('fecha'); 
        $asistencias = DB::table('asistencia')
            ->join('users', 'users.id', '=', 'asistencia.user_id')
            ->where('asistencia.clase_id', $claseSeleccionada)
            ->where('users.rol', 3) 
            ->select(
                'users.id as user_id', 'users.username', 
                DB::raw("CONCAT(users.name, ' ', users.apellido) as user_name"),
                'asistencia.id as asistencia_id',
                'asistencia.asistencia',
                'asistencia.fecha',
                'asistencia.clase_id'
            )
            ->distinct('users.id') 
            ->get();
        return view('maestro.asistencias.asistencias', compact('clases', 'fechasAsistencia', 'asistencias'));
    }

    public function guardarAsistencias(Request $request){
        $data = $request->input('asistencia');
        $claseSeleccionada;
        foreach ($data as $clase => $clase_id) {
            $claseSeleccionada = $clase;
            foreach ($clase_id as $asistencia_id => $fecha_asistencia) {
                foreach ($fecha_asistencia as $fecha => $asistencia) {
                    $registro = Asistencia::where('id', $asistencia_id)
                    ->where('fecha',$fecha)
                    ->first();
                    if ($registro) {
                        $registro->asistencia = $asistencia;
                        $registro->save();
                    }
                }
            }
        }
        return redirect()->route('maestros.misclases.informacion', ['clase' => $claseSeleccionada]);
    }



}

