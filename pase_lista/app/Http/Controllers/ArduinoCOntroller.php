<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Arduino;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Asistencia;

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
                $salon = $request->input('Aula');
                // Realiza la búsqueda en la tabla de la base de datos
                $usuario = Arduino::where('codigo_tarjeta', $rfid)->first();

                // Comprueba si se encontró el dato en la base de datos
                if ($usuario) {
                    date_default_timezone_set('America/Monterrey');
                    $hora=date('H:i:s');
                    // Si se encontró, responde con "1" a Arduino
                    if($usuario->rol==2){
                        $clase = Clase::where('user_id', $usuario->id)
                        ->where('hora_inicio', '<=', $hora)
                        ->where('hora_fin', '>=', $hora)
                        ->where('salon', $salon)
                        ->where('dia', $DiaSemana)
                        ->first();
                        if ($clase){
                            // Convierte la hora de string a objeto Carbon
                            if ($clase->estado == "desactivada"){
                                $clase->estado = 'activada';
                                $clase->save(); 
                                return "4";
                            }else{
                                $clase->estado = 'desactivada';
                                $clase->save();
                                return "5";
                            }
                        }else{
                            
                            return "6";
                        }
                        
                    }else{
                        $clase = Clase::where('salon', $salon)
                        ->where('estado', 'activada')
                        ->first();
                        return "1";
                        if ($clase){
                            $asistencia = new Asistencia();
                            $asistencia->clase_id = $clase->id; // Asignar el ID de la clase
                            $asistencia->user_id = $usuario->id; // Asignar el ID del usuario
                            $asistencia->asistencia = 1; // Asignar 1 para indicar asistencia
                            $asistencia->fecha = now(); // Asignar la fecha actual
                            $asistencia->save(); // Guardar la entrada de asistencia en la base de datos

                            return "1";
                            
                        }else{
                            
                            return "7";
                        } 
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
