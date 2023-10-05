<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    ////Funcion para retornar a la vista de clientes
    public function index(){
        //$clientes=Cliente::all();
        return view('admin.clase.clases');
    }

    //Funcion para retornar la vista de agregar clientes
    public function create(){
        //$paises = Country::all();
        return view('admin.clase.AgregarClase');
    }

    ////Funcion para retornar a la vista del listado de maestros
    public function visualizar(){
        //$clientes=Cliente::all();
        return view('admin.maestro.maestros');
    }

    //Funcion para retornar la vista de agregar maestro
    public function crear(){
        //$paises = Country::all();
        return view('admin.maestro.AgregarMaestro');
    }

    ////Funcion para retornar a la vista del listado de alumnos
    public function visualizarAlumno(){
        //$clientes=Cliente::all();
        return view('admin.alumno.alumno');
    }

    //Funcion para retornar la vista de agregar clientes
    public function crearAlumno(){
        //$paises = Country::all();
        return view('admin.alumno.AgregarAlumno');
    }
}
