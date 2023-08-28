<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmatriculaDetalle extends Model
{
    use HasFactory;
    public function ematricula(){
        return $this->belongsTo(Ematricula::class);
    }
}
