<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getdatos($dni){
        //vamos a verificar que ya no sea estudiante
        $estudiante = Estudiante::whereHas('postulante.cliente',function($query) use($dni){
            $query->where('dniRuc','=',$dni);
        })->get();
        if(count($estudiante)==0){
            //ahora verificamos si tiene cliente
            $cliente = Cliente::where('dniRuc','=',$dni)->first();
            if (isset($cliente->idCliente)){
                return json_encode($cliente);
            }else{
                //Ahora obtendremos los datos desde reniec
                //return "hay que obtener el DNI de RENIEC";
                $url = "https://dniruc.apisperu.com/api/v1/dni/".$dni."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImRhcGFyaWNpb0BpZGV4cGVydWphcG9uLmVkdS5wZSJ9.H_LluFT0wPMjlW4Ghtukx0bCYF6OCH7I5ykkMc_oLKM";
                $respuesta = file_get_contents($url);
                //voy a crear un array para luego devolverlo como un json;
                
                $respuesta =  json_decode($respuesta,true);
                $array = [
                    'idCliente'=>0,
                    'dniRuc'=>$respuesta['dni'],
                    'nombre'=>$respuesta['nombres'],
                    'apellido'=> $respuesta['apellidoPaterno'].' '. $respuesta['apellidoMaterno'],
                ];
                return json_encode($array);
            }
        }else{
            $array=['error'=>'ya es estudiante'];
            return $array;
        }
    }
}
