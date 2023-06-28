<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmisionePostulante extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function estudiantes(){
        return $this->hasMany(Estudiante::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class,'idCliente');
    }
    public function admisione(){
        return $this->belongsTo(Admisione::class);
    }
    public function carrera(){
        return $this->belongsTo(Carrera::class,'idCarrera','idCarrera');
    }
    public function estudiante(){
        return $this->hasOne(Estudiante::class,'admisione_postulante_id','id');
    }
}
