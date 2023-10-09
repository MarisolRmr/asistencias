<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ArduinoCOntroller;
use App\Http\Controllers\MaestrosController;
use App\Http\Controllers\EstudianteController;

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
    return view('auth.login');
});

// Mostrar el formulario de inicio de sesión
Route::get('/login', [LoginController::class,'loginForm'])->name('login');
// Procesar el formulario de inicio de sesión
Route::post('/login', [LoginController::class,'store'])->name('login.store');
Route::get('/logout',[LogoutController::class,'store'])->name('logout');

//ADMIN
//Ruta para la vista de listado de clases
Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
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
Route::post('/admin/grupos/create', [AdminController::class,'storeGrupo'])->name('admin.grupos.store');
//Ruta para la vista de listado 
Route::get('/admin/materia', [AdminController::class,'visualizarMateria'])->name('admin.materia.index');
//Ruta para la vista de agregar maestros
Route::get('/admin/materia/create', [AdminController::class,'crearMateria'])->name('admin.materia.create');
Route::post('/admin/materia/create', [AdminController::class,'storeMateria'])->name('admin.materia.store');


//MAESTROS
//dashboard
Route::get('/maestros/dashboard', [MaestrosController::class,'dashboard'])->name('maestros.dashboard');
//Ruta para la vista de listado de clases
Route::get('/maestros/misclases', [MaestrosController::class,'mis_clases'])->name('maestros.misclases');
//Ruta para la vista de seleccionar clases
Route::get('/maestros/misclases/informacion', [MaestrosController::class,'info_clase'])->name('maestros.misclases.informacion');

//ESTUDIANTES
Route::get('/estudiante/asistencias', [EstudianteController::class,'ver_asistencias'])->name('estudiante.asistencias.ver');
Route::get('/estudiante/elegirgrupo/', [EstudianteController::class,'elegirGrupo'])->name('estudiante.asistencias.elegir');







Route::post('/request', [ArduinoCOntroller::class,'handleRequest'])->name('arduino');
