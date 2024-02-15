<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function modulo(){
        return $this->belongsTo(Mformativo::class,'mformativo_id','id');
    }
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
    public function empresa(){
        return $this->belongsTo(Empresa::class,'empresa_id','idEmpresa');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
