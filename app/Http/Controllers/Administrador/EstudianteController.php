<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Estudiante;
use App\Models\Ucliente;
use App\Models\User;
use App\Traits\MailTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class EstudianteController extends Controller
{
    use MailTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {  
       $this->middleware('auth');
    }
    public function index()
    {
        //
        //$estudiantes = Estudiante::get();
        /* $estudiantes = Estudiante::select('*')
        ->join('admisione_postulantes','estudiantes.admisione_postulante_id','=','admisione_postulantes.id')
        ->join('clientes','clientes.idCliente','=','admisione_postulantes.idCliente')
        ->get(); */
        $estudiantes = Estudiante::get();
        return view('dashboard.administrador.estudiantes.index',compact('estudiantes'));
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateemail($id, Request $request){
    try {
        //code...
        DB::beginTransaction();
        $estudiante = Estudiante::findOrFail($id);
        $user = User::findOrFail($estudiante->postulante->cliente->ucliente->user->id);
        $cliente = Cliente::findOrFail($estudiante->postulante->cliente->idCliente);
        //actualizar correos
        $user->email = $request->email;
        $user->save();
        $cliente->email = $request->email;
        $cliente->save();
        DB::commit();
    } catch (\Throwable $th) {
        //throw $th;
        DB::rollBack();
        return Redirect::route('dashboard.administrador.alumnos.index')->with('error',$th->getMessage());
    }
        $this->sendReset($request);
        return Redirect::route('dashboard.administrador.alumnos.index')->with('info','se envio el correo con el link de restablecimiento de contraseña a'.$request->email);
    }
    public function makeaccountmassive(){
        //vamos
        $request = new Request();
        $estudiantes = Estudiante::get();
        $count = 0;
        foreach ($estudiantes as $estudiante) {
            # code...
            if(!isset($estudiante->postulante->cliente->ucliente->id)){
                $count ++;
                $estudiante = Estudiante::findOrFail($estudiante->id);
                $cliente = Cliente::findOrFail($estudiante->postulante->cliente->idCliente);
                //creamos la cuenta.
                $uss = User::where('email','=',$estudiante->postulante->cliente->email)->first();

                if(!isset($uss->id)){
                    $user = new User();
                    $user->name = $cliente->nombre.', '.$cliente->apellido;
                    $user->email = $cliente->email;
                    $user->password = bcrypt('Pj'.$cliente->dniRuc);
                    $user->idOficina = 10;
                    $user->save();
                    $request->merge(['email' => $user->email]);
                    $ucliente = new Ucliente();
                    $ucliente->user_id = $user->id;
                    $ucliente->cliente_id = $cliente->idCliente;
                    $ucliente->save();
                }else{
                    $request->merge(['email' => $uss->email]);
                    $ucliente = new Ucliente();
                    $ucliente->user_id = $uss->id;
                    $ucliente->cliente_id = $cliente->idCliente;
                    $ucliente->save();
                }
                
                $this->sendReset($request);
            }
            
        }
        return $count;
    }
    public function makeaccount($id,Request $request){
        try {
            //code...
            DB::beginTransaction();
            $estudiante = Estudiante::findOrFail($id);
            $cliente = Cliente::findOrFail($estudiante->postulante->cliente->idCliente);
            //creamos la cuenta.
            $user = new User();
            $user->name = $cliente->nombre.', '.$cliente->apellido;
            $user->email = $cliente->email;
            $user->password = bcrypt('Pj'.$cliente->dniRuc);
            $user->idOficina = 10;
            $user->save();
            $ucliente = new Ucliente();
            $ucliente->user_id = $user->id;
            $ucliente->cliente_id = $cliente->idCliente;
            $ucliente->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            return Redirect::route('dashboard.administrador.alumnos.index')->with('error',$th->getMessage());
        }
        $this->sendReset($request);
        return Redirect::route('dashboard.administrador.alumnos.index')->with('info','la cuenta se creo correctamente y la informacion se envio al siguiente correo'.$request->email);
    }
    public function resetpassword(Request $request,$id){
        /* $request->validate([
            'email'=>'required|email',
        ]);
        //ahora tenemos que crear la entrada en la base de datos.
        $user = User::where('email','=',$request->email)->first();
        dd($user->tokens());
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $url = asset('password/reset/'.$token.'?email='.$request->email);
        //ahora hay que construir el link de reseteo

        dd($url); */
    }
}
