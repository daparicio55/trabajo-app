<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espera extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function carrera(){
        return $this->belongsTo(Carrera::class,'carrera_id','idCarrera');
    }
    public function admisione(){
        return $this->belongsTo(Admisione::class,'admisione_id','id');
    }
}