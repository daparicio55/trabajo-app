<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacione extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function padre(){
        return $this->belongsTo(Ubicacione::class,'ubicacione_id','id');
    }
}
