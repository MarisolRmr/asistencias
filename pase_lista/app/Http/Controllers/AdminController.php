<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function index(){
        
        return view('admin.clase.clases');
    }

    public function create(){
        return view('admin.clase.AgregarClase');
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
        return view('admin.alumno.AgregarAlumno');
    }

    //Funcion para almacenar usuarios en la base de datos
    public function storeAlumnos(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'username' => 'required',
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
            'rol' => 3,
        ]);
        return redirect()->route('admin.alumnos.index')->with('success', 'El usuario ha sido registrado correctamente');
    }

    ////Funcion para retornar a la vista del listado de alumnos
    public function visualizarGrupo(){
        //$clientes=Cliente::all();
        return view('admin.grupo.grupo');
    }

    //Funcion para retornar la vista de agregar clientes
    public function crearGrupo(){
        //$paises = Country::all();
        return view('admin.grupo.AgregarGrupo');
    }

    public function storeGrupo(Request $request){
        //Se validan los campos
        $this->validate($request, [
            'nombre' => 'required',  
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
}
