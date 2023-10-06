<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
                $hora = $request->input('hora');
                $DiaSemana = $request->input('DiaSemana');
                $salon = $request->input('salon');
                // Realiza la búsqueda en la tabla de la base de datos
                $usuario = Arduino::where('codigo_tarjeta', $rfid)->first();

                // Comprueba si se encontró el dato en la base de datos
                if ($usuario) {
                    
                    // Si se encontró, responde con "1" a Arduino
                    if($usuario->rol==2){
                        // Convierte la hora de string a objeto Carbon
                        $horaCarbon = Carbon::createFromFormat('H:i:s', $hora);

                        // Utiliza las relaciones definidas para obtener las clases del usuario
                        $clases = $usuario->user->clases()
                            ->where('hora_inicio', '<=', $horaCarbon)
                            ->where('hora_fin', '>=', $horaCarbon)
                            ->where('DiaSemana', $DiaSemana)
                            ->where('salon', $salon)
                            ->get();

                        if ($clases->count() > 0) {
                            // Aquí $clases contiene las clases que cumplen con las condiciones
                            return $clases;
                        } else {
                            return "No hay clases para este usuario en esta hora y día en el salón especificado.";
                        }
                        
                    }else{
                       return "3"; 
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
