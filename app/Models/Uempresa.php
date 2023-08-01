<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uempresa extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'empresa_id',
        'user_id'
    ];
    public function empresa(){
        return $this->belongsTo(Empresa::class,'empresa_id','idEmpresa');
    }
}
