<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Admisione;
use App\Models\AdmisionePostulante;
use App\Models\Carrera;
use App\Models\Cliente;
use App\Models\Estudiante;
use App\Models\Postulacione;
use App\Models\Ucliente;
use App\Models\User;
use App\Traits\MailTrait;
use Carbon\Carbon;
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
       $this->middleware('can:dashboard.administrador.alumnos.index')->only('index');
       $this->middleware('can:dashboard.administrador.alumnos.create')->only('create','store');
       $this->middleware('can:dashboard.administrador.alumnos.edit')->only('edit','update');
       $this->middleware('can:dashboard.administrador.alumnos.destroy')->only('destroy');
       $this->middleware('can:dashboard.administrador.alumnos.show')->only('show');
    }
    public function index()
    {
        //
        //$estudiantes = Estudiante::get();
        /* $estudiantes = Estudiante::select('*')
        ->join('admisione_postulantes','estudiantes.admisione_postulante_id','=','admisione_postulantes.id')
        ->join('clientes','clientes.idCliente','=','admisione_postulantes.idCliente')
        ->get(); */
        $estudiantes = Estudiante::orderBy('id','desc')->get();
        return view('dashboard.administrador.estudiantes.index',compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sexos = ['Masculino'=>'Masculino','Femenino'=>'Femenino'];
        $modalidadTipo = ['Ordinario'=>'Ordinario','Exonerado'=>'Exonerado'];
        $modalidad = [
            'Ordinario'=>'Ordinario',
            'Artista Calificado'=>'Artista Calificado',
            'Comunidades Nativas y Campesinas'=>'Comunidades Nativas y Campesinas',
            'Desplazados Terrorismo y combatientes del Cenepa'=>'Desplazados Terrorismo y combatientes del Cenepa',
            'Personas con Discapacidad'=>'Personas con Discapacidad',
            '1er y 2do Puesto EBR - EBA'=>'1er y 2do Puesto EBR - EBA',
            '1er y 2do Puesto Cepre IDEX Perú Japón'=>'1er y 2do Puesto Cepre IDEX Perú Japón',
            'Servicio Militar'=>'Servicio Militar',
            'Deportistas Calificados'=>'Deportistas Calificados',
            'Traslado Interno'=>'Traslado Interno',
            'Titulados'=>'Titulados',
            'Reingresantes'=>'Reingresantes'
        ];
        $admisiones = Admisione::orderby('periodo','asc')->take(37)->pluck('periodo','id')->toArray();
        $carreras = Carrera::whereNull('ccarrera_id')->pluck('nombreCarrera','idCarrera')->toArray();
        return view('dashboard.administrador.estudiantes.create',compact('sexos','modalidadTipo','modalidad','carreras','admisiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            DB::beginTransaction();
            //creamos o actualizamos el cliente
            if($request->cliente == 0){
                $cliente = new Cliente();
                $cliente->dniRuc = $request->searchText;
                $cliente->apellido = $request->apellido;
                $cliente->nombre = $request->nombre;
                $cliente->telefono = $request->telefono;
                $cliente->telefono2 = $request->telefono2;
                $cliente->email = $request->email;
                $cliente->direccion = $request->direccion;
                $cliente->save();
            }else{
                $cliente = Cliente::findOrFail($request->cliente);
                $cliente->apellido = $request->apellido;
                $cliente->nombre = $request->nombre;
                $cliente->telefono = $request->telefono;
                $cliente->telefono2 = $request->telefono2;
                $cliente->email = $request->email;
                $cliente->direccion = $request->direccion;
                $cliente->update();
            }
            $numero = DB::table('admisione_postulantes')
            ->orderBy('expediente','desc')
            ->where('admisione_id',$request->admisione_id)
            ->first();
            if(isset($numero)){
                $expediente = $numero->expediente + 1;
            }else{
                $expediente = 1;
            }
            $hora = Carbon::now()->toTimeString();
            $fecha = Carbon::now()->toDateString();
            //ingresamos la postulacion
            $postulante = new AdmisionePostulante;
            $postulante->fecha = $fecha;
            $postulante->hora = $hora;
            $postulante->expediente = $expediente;
            $postulante->sexo = $request->sexo;
            $postulante->discapacidad = $request->discapacidad;
            $postulante->discapacidadNombre = $request->discapacidadNombre;
            $postulante->modalidadTipo = 'Exonerado';
            $postulante->modalidad = 'Historico';
            $postulante->url = 'noimagen';
            $postulante->fechaNacimiento = $request->fechaNacimiento;
            $postulante->idCliente = $cliente->idCliente;
            $postulante->idCarrera = $request->idCarrera;
            $postulante->admisione_id = $request->admisione_id;
            $postulante->colegio_id = 102;
            $postulante->boleta = $request->boleta;
            $postulante->user_id = auth()->user()->id;
            $postulante->save();
            //registro de estudiante
            $estudiante = new Estudiante;
            $estudiante->admisione_postulante_id = $postulante->id;
            $estudiante->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
            return Redirect::route('dashboard.administrador.alumnos.index')->with('error','ocurrio un error al guardar al estudiante');
        }
        return Redirect::route('dashboard.administrador.alumnos.index')->with('info','se guardo el estudiante correctamente');
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
        $estudiantes = Estudiante::whereHas('matriculas',function($query){
            $query->where('pmatricula_id','=',100);
        })->get();
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
                
                //$this->sendReset($request);
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
            //le damos permiso de empresa
            $user->assignRole('Bolsa User');
            //creamos la relacion con el cliente
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
