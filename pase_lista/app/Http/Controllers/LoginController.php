<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function loginForm(){
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user){
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Ruta para el administrador
        } elseif ($user->role === 'maestro') {
            return redirect()->route('maestro.dashboard'); // Ruta para el maestro
        } else {
            return redirect()->route('estudiante.dashboard'); // Ruta para el estudiante
        }
    }

    //Funcion para autentificar al usuario
    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // Comprobar si el usuario existe como correo electrónico o nombre de usuario
        $user = User::where('username', $request->username)
        ->orWhere('password', $request->password)
        ->first();

        if (!$user) {
        return back()->with('mensaje', 'El usuario o correo electrónico no fue encontrado.');
        }

        // Verificar las credenciales
        if (!auth()->attempt(['password' => $request->password, 'username' => $user->username], $request->remember) &&
        !auth()->attempt(['password' => $request->password, 'password' => $user->password], $request->remember)) {
        return back()->with('mensaje', 'Contraseña incorrecta, vuelva a intentarlo.');
        }



        // Redirecciona
        if ($user->role === 1) {
            return redirect()->route('admin.dashboard'); // Ruta para el administrador
        } elseif ($user->role === 2) {
            return redirect()->route('maestro.dashboard'); // Ruta para el maestro
        } elseif ($user->role === 3) {
            return redirect()->route('estudiante.dashboard'); // Ruta para el estudiante
        }
    }



}
