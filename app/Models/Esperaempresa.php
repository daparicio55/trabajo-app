<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esperaempresa extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function rubro(){
        return $this->belongsTo(Rubro::class);
    }
    public function sectore(){
        return $this->belongsTo(Sectore::class);
    }
}
