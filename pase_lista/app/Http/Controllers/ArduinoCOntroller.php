<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Arduino;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Hash;


class ArduinoCOntroller extends Controller
{
    public function handleRequest(Request $request)
    {
        try {
            // Obtén el dato enviado por Arduino
            $dato = $request->input('dato');
            date_default_timezone_set('America/Monterrey');
            $hora=date('H:i:s');
            $salon = $request->input('Aula');
            if ($dato == "1") {
                
                $rfid = $request->input('rfid');
                $DiaSemana = $request->input('DiaSemana');
                
                // Realiza la búsqueda en la tabla de la base de datos
                $usuario = Arduino::where('codigo_tarjeta', $rfid)->first();
                
                // Comprueba si se encontró el dato en la base de datos
                if ($usuario) {
                    
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
                        if ($clase){
                            $asistenciaExistente = Asistencia::where('clase_id', $clase->id)
                            ->where('user_id', $usuario->id)
                            ->where('asistencia', 1)
                            ->first();
                            if (!$asistenciaExistente) {
                                $asistencia = new Asistencia([
                                    'clase_id' => $clase->id,
                                    'user_id' => $usuario->id,
                                    'asistencia' => 1,
                                    'fecha' => now(),
                                ]);
                            
                                try {
                                    $asistencia->save();
                                    return "1";
                                } catch (\Exception $e) {
                                    return "3";
                                }
                            }else{
                                return "7";
                            }
                            
                        }else{
                            
                            return "8";
                        } 
                    }

                } else {
                    // Si no se encontró, responde con "2" a Arduino
                    return  "2";
                }
            } elseif ($dato == "2") {
                $username = $request->input('username');
                $password = $request->input('password');

                $usuario = Arduino::where('username', $username)->first();

                if (!$usuario) {
                    return "2";
                }else{
                    if (Hash::check($password, $user->password)) {
                        return 1;
                        $DiaSemana = $request->input('DiaSemana');
                        
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
                            
                            if ($clase){
                                $asistenciaExistente = Asistencia::where('clase_id', $clase->id)
                                ->where('user_id', $usuario->id)
                                ->where('asistencia', 1)
                                ->first();
                                if (!$asistenciaExistente) {
                                    $asistencia = new Asistencia([
                                        'clase_id' => $clase->id,
                                        'user_id' => $usuario->id,
                                        'asistencia' => 1,
                                        'fecha' => now(),
                                    ]);
                                
                                    try {
                                        $asistencia->save();
                                        return "1";
                                    } catch (\Exception $e) {
                                        return "3";
                                    }
                                }else{
                                    return "7";
                                }
                                
                            }else{
                                
                                return "8";
                            } 
                        }
                        return "1";
                    }else{
                        return "2";
                    }
                }

            }  elseif ($dato == "3") {
                $clase = Clase::where('salon', $salon)
                        ->where('estado', 'activada')
                        ->first();
                if ($clase){
                    if ($hora > $clase->hora_fin){
                        $clase->estado = 'desactivada';
                        $clase->save();
                    }
                }      
            }  else {
                // Dato inválido desde Arduino, responde con "2"
                return  "2";
            }
        } catch (\Exception $e) {
            // Error de conexión de base de datos u otro error, responde con "3"
            return "3";
        }
    }

}
