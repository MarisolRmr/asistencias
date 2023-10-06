<?php

namespace App\Http\Controllers;
use App\Models\Arduino;
use Illuminate\Http\Request;

class ArduinoCOntroller extends Controller
{
    public function handleRequest(Request $request)
    {
        try {
            // Obtén el dato enviado por Arduino
            $dato = $request->input('dato');

            if ($dato == "1") {
                $rfid = $request->input('rfid');
                // Realiza la búsqueda en la tabla de la base de datos
                $usuario = Arduino::where('codigo_tarjeta', $rfid)->first();

                // Comprueba si se encontró el dato en la base de datos
                if ($usuario) {
                    // Si se encontró, obtén el rol del usuario
                    $rol = $usuario->rol;
                    return $rol;
                    // Si el rol es igual a 2, significa que es un usuario con el rol 2
                    /*if ($rol == 2) {
                        // Obten la hora actual
                        $horaActual = now()->format('H:i:s');
                        // Busca las clases relacionadas con el usuario y la hora actual dentro del rango
                        $clases = Clase::where('id_usuario', $usuario->id)
                            ->whereTime('hora_inicio', '<=', $horaActual)
                            ->whereTime('hora_fin', '>=', $horaActual)
                            ->get();
                        // Responde con las clases encontradas
                         response()->json(['clases' => $clases,'hora'=>$horaActual]);
                    } else {
                        // Si no es un usuario con rol 2, responde con "Rol no válido" a Arduino
                        return "Rol no válido";
                    }*/
                } else {
                    // Si no se encontró, responde con "2" a Arduino
                    return "2";
                }
            } elseif ($dato == "2") {
                $username = $request->input('username');
                $password = $request->input('password');

                // Realiza la búsqueda en la tabla de la base de datos
                $resultado = Arduino::where('username', $username)
                    ->where('password', $password)
                    ->first();

                // Comprueba si se encontró el dato en la base de datos
                if ($resultado) {
                    // Si se encontró, responde con "1" a Arduino
                    return "1";
                } else {
                    // Si no se encontró, responde con "2" a Arduino
                    return "2";
                }
            } else {
                // Dato inválido desde Arduino, responde con "2"
                return  "2";
            }
        } catch (\Exception $e) {
            // Error de conexión de base de datos u otro error, responde con "3"
            return "3";
        }
    }

}
