<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MaestrosController;
use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArduinoCOntroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('listado');
});

//Ruta para la vista de listado de clases
Route::get('/admin/clases', [AdminController::class,'index'])->name('admin.clases.index');
//Ruta para la vista de agregar clases
Route::get('/admin/clases/create', [AdminController::class,'create'])->name('admin.clases.create');

//Ruta para la vista de listado de maestros
Route::get('/admin/maestros', [AdminController::class,'visualizar'])->name('admin.maestros.index');
//Ruta para la vista de agregar maestros
Route::get('/admin/maestros/create', [AdminController::class,'crear'])->name('admin.maestros.create');
Route::post('/admin/maestros/create', [AdminController::class,'storeMaestros'])->name('admin.maestros.store');

//Ruta para la vista de listado de alumnos
Route::get('/admin/alumnos', [AdminController::class,'visualizarAlumno'])->name('admin.alumnos.index');
//Ruta para la vista de agregar maestros
Route::get('/admin/alumnos/create', [AdminController::class,'crearAlumno'])->name('admin.alumnos.create');
Route::post('/admin/alumnos/create', [AdminController::class,'storeAlumnos'])->name('admin.alumnos.store');

//Ruta para la vista de listado 
Route::get('/admin/grupos', [AdminController::class,'visualizarGrupo'])->name('admin.grupos.index');
//Ruta para la vista de agregar maestros
Route::get('/admin/grupos/create', [AdminController::class,'crearGrupo'])->name('admin.grupos.create');
Route::post('/admin/maestros/create', [AdminController::class,'storeGrupo'])->name('admin.maestros.store');

//Ruta para la vista de listado 
Route::get('/admin/materia', [AdminController::class,'visualizarMateria'])->name('admin.materia.index');
//Ruta para la vista de agregar maestros
Route::get('/admin/materia/create', [AdminController::class,'crearMateria'])->name('admin.materia.create');
Route::post('/admin/maestros/create', [AdminController::class,'storeMaestros'])->name('admin.maestros.store');



//MAESTROS
//Ruta para la vista de listado de clases
Route::get('/maestros/clases', [MaestrosController::class,'ver_clases'])->name('maestros.clases.ver');
//Ruta para la vista de listado de horarios
Route::get('/maestros/horarios', [MaestrosController::class,'ver_horarios'])->name('maestros.horarios.ver');
//Ruta para la vista de listado de Asistencias
Route::get('/maestros/asistencias', [MaestrosController::class,'seleccionar_asistencias'])->name('maestros.asistencias.seleccionar');
//Ruta para la vista de editar de Asistencias
Route::get('/maestros/asistencias/editar', [MaestrosController::class,'editar_asistencias'])->name('maestros.asistencias.editar');

//ESTUDIANTES
Route::get('/estudiante/asistencias', [EstudianteController::class,'ver_asistencias'])->name('estudiante.asistencias.ver');

Route::post('/request', [ArduinoCOntroller::class,'handleRequest'])->name('arduino');
