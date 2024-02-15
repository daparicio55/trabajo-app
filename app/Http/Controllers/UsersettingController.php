<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatepasswordRequest;
use App\Models\AdmisionePostulante;
use App\Models\Cliente;
use App\Models\Curso;
use App\Models\Experiencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;

class UsersettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function __construct()
    {
        /* $this->middleware('auth');
        $this->middleware('can:dashboard.settings.index')->only('index');
        $this->middleware('can:dashboard.settings.edit')->only('edit','update');
        $this->middleware('can:dashboard.settings.create')->only('create','store');
        $this->middleware('can:dashboard.settings.destroy')->only('destroy');
        $this->middleware('can:dashboard.settings.show')->only('show');
        $this->middleware('can:dashboard.settings.edit_password')->only('edit_password');
        $this->middleware('can:dashboard.settings.update_password')->only('update_password'); */
    }
    public function index()
    {
        //
        return Redirect::route('dashboard.settings.edit',auth()->id());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::findOrFail($id);
        return view('dashboard.settings.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            $id = auth()->id();
            $user = User::findOrFail($id);
            $cliente = Cliente::findOrFail($user->ucliente->cliente->idCliente);
            $cliente->telefono = $request->telefono1;
            $cliente->telefono2 = $request->telefono2;
            $cliente->direccion = $request->direccion;
            $cliente->save();
            AdmisionePostulante::where('idCliente','=',$cliente->idCliente)->update(['fechaNacimiento'=>$request->nacimiento]);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::route('user_dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function edit_password(){
        $user = User::findOrFail(auth()->id());
        return view('dashboard.settings.edit_password',compact('user'));
    }
    public function update_password(UpdatepasswordRequest $request){
        $user = User::findOrFail(auth()->id());
        $user->password = bcrypt($request->password1);
        $user->update();
        return Redirect::route('user_dashboard.index');
    }
    public function store_experiencia(Request $request){
        try {
            //code...
            $experiencia = new Experiencia();
            $experiencia->user_id = auth()->user()->id;
            $experiencia->empresa = $request->empresa;
            $experiencia->cargo = $request->cargo;
            $experiencia->exinicio = $request->xfinicio;
            if ($request->actual == true){
                $experiencia->actual = True;
            }else{
                $experiencia->exfin = $request->xffin;
            }
            $experiencia->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            $arry = [
                'message' => $th->getMessage()
            ];
            return json_encode($arry);
        }
        
    }
    public function store_curso(Request $request){
        try {
            //code...
            $curso = new Curso();
            $curso->user_id = auth()->user()->id;
            $curso->institucion = $request->institucion;
            $curso->mension = $request->mension;
            $curso->inicio = $request->cuinicio;
            $curso->fin = $request->cufin;
            $curso->horas = $request->horas;
            $curso->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            $arr = [
                'message'=>$th->getMessage()
            ];
        }
    }
    public function index_experiencia(){
        $experiencias = Experiencia::where('user_id','=',auth()->user()->id)
        ->orderBy('exinicio','desc')
        ->get();
        return $experiencias;
    }
    public function index_curso(){
        $cursos = Curso::where('user_id','=',auth()->user()->id)
        ->orderBy('inicio','desc')
        ->get();
        return $cursos;
    }
    public function delete_experiencia($id){
        try {
            //code...
            $experiencia = Experiencia::findOrFail($id);
            $experiencia->delete();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            $arr = [
                'message' => $th->getMessage()
            ];
            return json_encode($arr);
        }
    }
    public function delete_curso($id){
        try {
            //code...
            $curso = Curso::findOrFail($id);
            $curso->delete();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            $arr = [
                'message' => $th->getMessage(),
            ];
            return json_encode($arr);
        }
    }
}
