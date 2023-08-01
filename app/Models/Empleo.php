<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ubicacione;

class Empleo extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function empresa(){
        return $this->belongsTo(Empresa::class,'empresa_id','idEmpresa');
    }
    public function ubicacione(){
        return $this->belongsTo(Ubicacione::class);
    }
    public function turno(){
        return $this->belongsTo(Empleoturno::class,'empleoturno_id','id');
    }
    public function postulaciones(){
        return $this->hasMany(Postulacione::class);
    }
    public function synccarreras($carreras){
        try {
            for ($i=0; $i < count($carreras) ; $i++) { 
                # code...
                $carreraempleos = new CarreraEmpleo();
                $carreraempleos->carrera_id = $carreras[$i];
                $carreraempleos->empleo_id = $this->id;
                $carreraempleos->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
