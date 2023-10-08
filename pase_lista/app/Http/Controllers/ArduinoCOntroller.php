<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Arduino;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Asistencia;
use App\Models\Users_Grupos;
use App\Models\Aula;
use App\Models\Grupo;

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
                            ->whereHas('aula', function ($query) use ($salon) {
                                $query->where('nombre', $salon);
                            })
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
                        $clase = Clase::whereHas('aula', function ($query) use ($salon) {
                            $query->where('nombre', $salon);
                        })
                        ->where('estado', 'activada')
                        ->where('id_grupo', function ($query) use ($usuario) {
                            $query->select('id_grupo')
                                ->from('users_grupos')
                                ->where('user_id', $usuario->id);
                        })
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
                                
                        } else {
                            return "8"; // La clase no está activada
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
                    if (Hash::check($password, $usuario->password)) {
                         $DiaSemana = $request->input('DiaSemana');
                         // Si se encontró, responde con "1" a Arduino
                        if($usuario->rol==2){
                            $clase = Clase::where('user_id', $usuario->id)
                            ->where('hora_inicio', '<=', $hora)
                            ->where('hora_fin', '>=', $hora)
                            ->whereHas('aula', function ($query) use ($salon) {
                                $query->where('nombre', $salon);
                            })
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
                            
                        } else {
                            $clase = Clase::whereHas('aula', function ($query) use ($salon) {
                                $query->where('nombre', $salon);
                            })
                            ->where('estado', 'activada')
                            ->where('id_grupo', function ($query) use ($usuario) {
                                $query->select('id_grupo')
                                    ->from('users_grupos')
                                    ->where('user_id', $usuario->id);
                            })
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
                                
                            } else {
                                return "8"; // La clase no está activada
                            } 
                        }
                        
                    }else{
                        return "2";
                    }
                }


            }  elseif ($dato == "3") {
                $DiaSemana = $request->input('DiaSemana');
                // Primero, buscar y desactivar clases con $hora mayor que hora_fin y que estén activas
                $clasesActivas = Clase::whereHas('aula', function ($query) use ($salon) {
                    $query->where('nombre', $salon);
                })
                ->where('estado', 'activada')
                ->where('dia', $DiaSemana)
                ->where('hora_fin', '<', $hora)
                ->get();

                foreach ($clasesActivas as $claseActiva) {
                    $claseActiva->estado = 'desactivada';
                    $claseActiva->save();
                }


                // Obtener todas las clases cuyo $hora sea mayor a su $hora_fin
                $clases = Clase::where('hora_inicio', '<=', $hora)
                    ->where('dia', $DiaSemana)
                    ->get();
                
                foreach ($clases as $clase) {
                    
                    // Obtener todos los usuarios con el mismo id_grupo en users_grupos
                    $usuarios = Users_Grupos::where('id_grupo', $clase->id_grupo)
                        ->pluck('user_id');
                        return $usuarios;
                    
                    foreach ($usuarios as $userId) {
                        // Verificar si ya existe un registro de asistencia con asistencia igual a 1 en la misma clase
                        $asistenciaExistente = Asistencia::where('clase_id', $clase->id)
                            ->where('user_id', $userId)
                            ->where('asistencia', 1)
                            ->first();

                        if (!$asistenciaExistente) {
                            // Crear un nuevo registro de asistencia con asistencia igual a 0
                            $asistencia = new Asistencia([
                                'clase_id' => $clase->id,
                                'user_id' => $userId,
                                'asistencia' => 0,
                                'fecha' => now(),
                            ]);

                            $asistencia->save(); // Guardar el registro de asistencia
                        }
                    }
                }

                

                return "entreeee"; 
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
