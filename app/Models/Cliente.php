<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'idCliente';
    public $timestamps = false;
    public function postulantes(){
        return $this->hasMany(AdmisionePostulante::class,'idCliente');
    }
    public $fillable = [
        'dniRuc',
        'nombre',
        'apellido',
        'direccion',
        'email',
        'telefono',
        'telefono2',
    ];
    public function ucliente(){
        return $this->hasOne(Ucliente::class,'cliente_id');
    }
    public function postulaciones(){
        return $this->hasMany(AdmisionePostulante::class,'idCliente');
    }

    public function getNombreAttribute($value)
    {
        return Str::title($value);
    }

    public function getApellidoAttribute($value)
    {
        return Str::upper($value);
    }
}
