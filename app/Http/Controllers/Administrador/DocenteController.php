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
        $this->middleware('auth');
        $this->middleware(('can:dashboard.administrador.docentes.index'))->only('index');
    }
    public function index(){
        $docentes = User::role('Docentes')->get();
        return view('dashboard.administrador.docentes.index',compact('docentes'));
    }

}
