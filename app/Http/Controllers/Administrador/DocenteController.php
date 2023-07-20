<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    //
    public function __construct()
    {
        
    }
    public function index(){
        $docentes = User::role('Docentes')->get();
        return view('dashboard.administrador.docentes.index',compact('docentes'));
    }

}
