<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = "ccarreras";
    protected $primarykey = "idCarrera";
    public $timestamps = false;
    public function clientes(){
        return $this->hasMany(Espera::class);
    }
    public function mformativos(){
        return $this->hasMany(Mformativo::class,'carrera_id','idCarrera');
    }
}
