<?php

namespace App\Http\Controllers;
use App\Models\Arduino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\GeoIP;

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
                    // Si se encontró, responde con "1" a Arduino
                    if ($usuario->rol == 2) {
                        // Obtenemos la ubicación del usuario.
                        $ubicacion = GeoIP::getLocation();
                    
                        // Obtenemos la zona horaria del usuario.
                        $zonaHoraria = $ubicacion->timezone;
                    
                        // Obtenemos la hora actual en la zona horaria del usuario.
                        $horaActual = Carbon::now($zonaHoraria)->format('H:i:s');
                    
                        // Devolvemos la hora actual.
                        return strval($horaActual);
                    } else {
                        // Si el usuario no tiene el rol 2, devolvemos un valor predeterminado.
                        return '3';
                    }

                } else {
                    // Si no se encontró, responde con "2" a Arduino
                    return  "2";
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
