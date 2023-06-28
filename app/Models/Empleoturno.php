<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleoturno extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function empleos(){
        return $this->hasMany(Empleo::class);
    }
}
