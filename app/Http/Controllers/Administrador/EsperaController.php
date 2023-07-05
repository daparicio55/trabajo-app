<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Admisione;
use App\Models\AdmisionePostulante;
use App\Models\Carrera;
use App\Models\Cliente;
use App\Models\Espera;
use App\Models\Estudiante;
use App\Models\Ucliente;
use App\Models\User;
use App\Traits\MailTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Password;

class EsperaController extends Controller
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
        $sexos = ['Masculino'=>'Masculino','Femenino'=>'Femenino'];
        $programas = Carrera::orderBy('nombreCarrera','asc')->pluck('nombreCarrera','idCarrera')->toArray();
        $admisiones = Admisione::orderBy('nombre','desc')->pluck('periodo','id')->toArray();
        $esperas = Espera::orderBy('id','desc')->get();
        return view('dashboard.administrador.esperas.index',compact('esperas','programas','admisiones','sexos'));
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
        try {
            DB::beginTransaction();
            $cliente = Cliente::updateOrCreate([
                'dniRuc'=>$request->dni,
            ],
            [
                'nombre'=>$request->nombre,
                'apellido'=>$request->apellido,
                'direccion'=>'sin direccion s/n',
                'email'=>$request->email,
                'telefono'=>$request->telefono1,
                'telefono2'=>$request->telefono2
            ]);
            //ingreso su postulacion
            $postulacion = AdmisionePostulante::where('idCliente','=',$cliente->id)
            ->where('admisione_id','=',$request->periodo)
            ->get();
            if(isset($postulacion->id)){
                //ya existe la postulacion entonces
            }else{
                //no existe la postulacion y debemos de actualizarla
                $expediente = 1;
                $last_postulante = AdmisionePostulante::where('admisione_id','=',$request->periodo)
                ->orderBy('expediente','desc')
                ->first();
                if(isset($last_postulante->id)){
                    //tenemos que calcular el expediente;
                    $expediente = $last_postulante->expediente + 1;
                }                
                $postulante = new AdmisionePostulante();
                $postulante->fecha= Carbon::now();
                $postulante->hora= Carbon::now();
                $postulante->sexo= $request->sexo;
                $postulante->discapacidad= 1;
                $postulante->discapacidadNombre= "-";
                $postulante->url= "-";
                $postulante->idCliente= $cliente->idCliente; 
                $postulante->idCarrera= $request->programa;
                $postulante->admisione_id= $request->periodo;
                $postulante->colegio_id= 1;
                $postulante->user_id= auth()->id();
                $postulante->modalidadTipo= "Exonerado";
                $postulante->modalidad= "Historico";
                $postulante->fechaNacimiento= $request->nacimiento;
                $postulante->boleta= "0";
                $postulante->expediente= $expediente;
                $postulante->anulado= "NO";
                $postulante->correctas= 0;
                $postulante->incorrectas= 0 ;
                $postulante->blanco= 0;
                $postulante->bonificacion= 0;
                $postulante->puntaje= 0;
                $postulante->total= 0;
                $postulante->save();
                //ahora lo registramos como estudiante
                $estudiante = new Estudiante();
                $estudiante->admisione_postulante_id = $postulante->id;
                $estudiante->licencia = "NO";
                $estudiante->contrato = false;
                $estudiante->save();
                //ahora lo registramos como usuarios del sistema.
                $user = new User();
                $user->name = $cliente->nombre.' '.$cliente->apellido;
                $user->email = $cliente->email;
                $user->password = bcrypt('12345678');
                $user->idOficina = 10;
                $user->save();
                //ahora lo registro en la tabla intermedia
                $ucliente = new Ucliente();
                $ucliente->user_id = $user->id;
                $ucliente->cliente_id = $cliente->idCliente;
                $ucliente->save();
                //borramos la espera con ese dni
                $waiting = Espera::where('dniRuc','=',$request->dni)->delete();
            }
            DB::commit();
            //code...
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('dashboard.administrador.esperas.index')->with('error',$th->getMessage());
        }
        $this->sendReset($request);
        return Redirect::route('dashboard.administrador.esperas.index')->with('info','se registro al estudiante en el sistema');
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
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //code...
            $espera = Espera::findOrFail($id);
            $espera->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return view('dashboard.administrador.esperas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('dashboard.administrador.esperas.index')->with('info','el registro se elmino correctamente');
    }
}
