<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postulacione extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    public function empleo(){
        return $this->belongsTo(Empleo::class)->withTrashed();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
