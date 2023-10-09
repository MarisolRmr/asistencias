<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Clase;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Users_Grupos;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        // Para verificar que el user este autenticado
        // except() es para indicar cuales metodos pueden usarse sin autenticarse
        $this->middleware('auth');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function index(){
        $clase=Clase::all();
        return view('admin.clase.clases',['clase'=>$clase]);
    }

    public function create(){
        //$marcas=Marca::all();
        $user = User::where('rol', 2)->get();
        $materias= Materia::all();
        $grupo=Grupo::all();
        $aula=Aula::all();
        return view('admin.clase.AgregarClase',['user'=>$user,'materias'=>$materias,'grupo'=>$grupo,'aula'=>$aula]);
    }

    public function storeClase(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'materia' => 'required',
            'grupo' => 'required',
            'maestro' => 'required',
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'aula' => 'required',
            
        ]);
        //Se añade el registro a la base de datos
        Clase::create([
            'materia_id' => $request->materia,
            'id_grupo' => $request->grupo,
            'user_id' => $request->maestro,
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => 'desactivada',
            'id_aula'=>$request->aula

            
        ]);
        return redirect()->route('admin.clases.index')->with('success', 'El usuario ha sido registrado correctamente');
    }

    
    ////Funcion para retornar a la vista del listado de maestros
    public function visualizar(){
        $usuarios = User::where('rol', 2)->get();
        return view('admin.maestro.maestros', ['usuarios' => $usuarios]);
    }

    //Funcion para retornar la vista de agregar maestro
    public function crear(){
        //$paises = Country::all();
        return view('admin.maestro.AgregarMaestro');
    }

    //Funcion para almacenar usuarios en la base de datos
    public function storeMaestros(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'codigoTarjeta' => 'required',
            
        ]);
        //Se añade el registro a la base de datos
        User::create([
            'name' => $request->nombre,
            'apellido' => $request->apellido,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'codigo_tarjeta' => $request->codigoTarjeta,
            'rol' => 2,
        ]);
        return redirect()->route('admin.maestros.index')->with('success', 'El usuario ha sido registrado correctamente');
    }
    

    ////Funcion para retornar a la vista del listado de alumnos
    public function visualizarAlumno(){
        $usuarios = User::where('rol', 3)->get();
        
        return view('admin.alumno.alumno', ['usuarios' => $usuarios]);
    }

    //Funcion para retornar la vista de agregar clientes
    public function crearAlumno(){
        //$paises = Country::all();
        $grupos = Grupo::all();
        return view('admin.alumno.AgregarAlumno',['grupos' => $grupos]);
    }

    //Funcion para almacenar usuarios en la base de datos
    public function storeAlumnos(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'codigoTarjeta' => 'required',
            
        ]);
        //Se añade el registro a la base de datos
        $usuario = User::create([
            'name' => $request->nombre,
            'apellido' => $request->apellido,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'codigo_tarjeta' => $request->codigoTarjeta,
            'rol' => 3,
        ]);
    
        // Asocia los grupos seleccionados al usuario
        if ($request->has('grupos')) {
            $gruposSeleccionados = $request->input('grupos');
            foreach ($gruposSeleccionados as $grupoId) {
                Users_Grupos::create([
                    'user_id' => $usuario->id,
                    'id_grupo' => $grupoId,
                ]);
            }
        }
        



        return redirect()->route('admin.alumnos.index')->with('success', 'El usuario ha sido registrado correctamente');
    }

    ////Funcion para retornar a la vista del listado de alumnos
    public function visualizarGrupo(){
        $grupo=Grupo::all();
        return view('admin.grupo.grupo',['grupo'=>$grupo]);
    }

    //Funcion para retornar la vista de agregar clientes
    public function crearGrupo(){
        //$paises = Country::all();
        return view('admin.grupo.AgregarGrupo');
    }

    public function storeGrupo(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'nombre' => 'required|unique:grupo',  
        ]);
        //Se añade el registro a la base de datos
        Grupo::create([
            'nombre' => $request->nombre,
        ]);
        return redirect()->route('admin.grupos.index')->with('success', 'El grupo ha sido registrado correctamente');
    }
    
     ////Funcion para retornar a la vista del listado de alumnos
    public function visualizarMateria(){
        $materia=Materia::all();
        return view('admin.materia.materia',['materia'=>$materia]);
    }

    //Funcion para retornar la vista de agregar clientes
    public function crearMateria(){
        //$paises = Country::all();
        return view('admin.materia.AgregarMateria');
    }
    public function storeMateria(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'nombre' => 'required',  
        ]);
        //Se añade el registro a la base de datos
        Materia::create([
            
            'nombre' => $request->nombre,
        ]);
        return redirect()->route('admin.materia.index')->with('success', 'La materia ha sido registrado correctamente');
    }

    public function visualizarAula(){
        $aula=Aula::all();
        return view('admin.aula.aula',['materia'=>$aula]);
    }

    //Funcion para retornar la vista de agregar clientes
    public function crearAula(){
        //$paises = Country::all();
        return view('admin.aula.AgregarAula');
    }
    public function storeAula(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'nombre' => 'required|unique:aula',  
        ]);
        //Se añade el registro a la base de datos
        Aula::create([
            
            'nombre' => $request->nombre,
        ]);
        return redirect()->route('admin.aulas.index')->with('success', 'La materia ha sido registrado correctamente');
    }

}
