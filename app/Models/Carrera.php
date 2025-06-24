<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = "ccarreras";
    public $primaryKey = "idCarrera";
    public $timestamps = false;
    public function clientes(){
        return $this->hasMany(Espera::class);
    }
    public function mformativos(){
        return $this->hasMany(Mformativo::class,'carrera_id','idCarrera');
    }

    public function anterior(){
        return $this->belongsTo(Carrera::class,'ccarrera_id','idCarrera');
    }

    public function siguiente(){
        return $this->hasOne(Carrera::class,'ccarrera_id','idCarrera');
    }

    public function obtenerSuperior(){
        $carrera = $this;
        while ($carrera->siguiente) {
            $carrera = $carrera->siguiente;
        }
        return $carrera;
    }

    public function arrayIds(){
        $superior = $this->obtenerSuperior();
        $array = [];
        $array[] = $superior->idCarrera;
        while ($superior->anterior){
            $array[] = $superior->anterior->idCarrera;
            $superior = $superior->anterior;
        }
        return $array;
    }
  
}
