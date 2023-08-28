<?php

use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;

function egresado($estudiante_id)  {
    //tenemos que verificar todos sus unidades didacticas
    //pero necesito en id de estudiante primero
    //$array=[];
    $estudiante = Estudiante::findOrFail($estudiante_id);
    //sacamos todoas sus unidades didacticas
    foreach ($estudiante->postulante->carrera->mformativos as $key => $mformativo) {
        # code...
        foreach ($mformativo->udidacticas as $key => $udidactica) {
            //ahora tengo la lista de las unidades didacticas.
            //ahora tengo que buscar si tienen notas en eso
            $notes = EmatriculaDetalle::wherehas('ematricula',function($query) use($udidactica,$estudiante){
                $query->where('estudiante_id','=',$estudiante->id)
                ->where('udidactica_id','=',$udidactica->id);
            })->get();           
            $nota = 0;
            foreach ($notes as $key => $note) {
                # code...
                //vamos a sacar el mayor de todos los numeros
                $no = $note->nota;
                if($no > $nota){
                    $nota = $no;
                }
            }
            if ($nota<13){
                return false;
            }
        }
    }
    return true;
}