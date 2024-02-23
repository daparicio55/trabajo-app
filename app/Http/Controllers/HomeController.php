<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaEsperaStoreRequest;
use App\Http\Requests\UserCreateRequest;
use App\Mail\UserEsperaMailable;
use App\Models\Admisione;
use App\Models\Carrera;
use App\Models\Empleo;
use App\Models\Espera;
use App\Models\Esperaempresa;
use App\Models\Estudiante;
use App\Models\Rubro;
use App\Models\Sectore;
use App\Models\Ubicacione;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function empleo_search(Request $request){
        //aca buscamos segun el criterio ingresado en el formulario.
        $request->validate([
            'location'=>[
                'required', function($attribute,$value,$fail){
                    if($value == 0){
                        $fail('seleccione una ubicación');
                    }
                }
            ],
            'carrera'=>[
                'required',function($attribute,$value,$fail){
                    if($value == 0){
                        $fail('seleccione un programa');
                    }
                }
            ]
        ]);
        try {
            $array_ubicaciones = [];
            //code...
            /* $empleos = Empleo::where('ubicacione_id','=',$request->location)->where('descripcion','like','%'.$request->searchText.'%')->get(); */
            $carrera = Carrera::where('idCarrera','=',$request->carrera)->first();
            if($carrera->ccarrera_id == null){
                //buscamos una nueva
                $carrera_id = Carrera::where('ccarrera_id','=',$carrera->idCarrera)->first()->idCarrera;
            }else{
                $carrera_id = $carrera->idCarrera;
            }
            $ubicacion = Ubicacione::findOrFail($request->location);
            //dd(isset($ubicacion->padre->padre->id));
            if(isset($ubicacion->padre->id)){
                if(isset($ubicacion->padre->padre->id)){
                    //ciudad nivel
                    $ubicaciones = Ubicacione::where('id','=',$request->location)->get();
                    foreach($ubicaciones as $ubicacione){
                        array_push($array_ubicaciones,$ubicacione->id);
                    }
                }else{
                    //distrito
                    $ubicaciones = Ubicacione::where('ubicacione_id','=',$request->location)->get();
                    foreach($ubicaciones as $ubicacione){
                        array_push($array_ubicaciones,$ubicacione->id);
                    }
                }
            }else{
                //departamento
                $provincias = Ubicacione::where('ubicacione_id','=',$request->location)->get();
                foreach ($provincias as $key => $provincia) {
                    # code...
                    $distritos = Ubicacione::where('ubicacione_id','=',$provincia->id)->get();
                    //tengo los distritos
                    foreach ($distritos as $key => $distrito) {
                        # code...
                        array_push($array_ubicaciones,$distrito->id);
                    }
                }
            }
            $empleos = Empleo::whereHas('carreras',function($query) use($carrera_id) {
                $query->where('carrera_id','=',$carrera_id);
            })->whereIn('ubicacione_id',$array_ubicaciones)->get();
            return view('empleos_show',compact('empleos'));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function empleos_show(){

    }
    public function empleo_show($id){
        
        $empleo = Empleo::findOrFail($id);
        return view('empleo',compact('empleo'));
    }
    public function index()
    {
        /* $user = User::where('email','=','daparicio@idexperujapon.edu.pe')->first(); */
        $ubicaciones = Ubicacione::get();
        $empleos = Empleo::orderBy('fecha_registro','desc')->take(5)->get();
        $carreras = Carrera::get();
        return view('index',compact('empleos','user','ubicaciones','carreras'));
    }
    public function create()
    {
        
        $programas = Carrera::orderBy('nombreCarrera','asc')->get();
        $admisiones = Admisione::orderBy('nombre','desc')->get();
        return view('user_create',compact('admisiones','programas'));
    }
    public function bussines_create(){
        $sectores = Sectore::get();
        $rubros = Rubro::get();
        return view('bussines_create',compact('sectores','rubros'));
    }
    public function store(UserCreateRequest $request){
        try {
            //guardamos los valores de los request. 
            $espera = new Espera();
            $espera->dniRuc= $request->dniRuc;
            $espera->apellido= $request->apellido;
            $espera->nombre= $request->nombre;
            $espera->fnacimiento= $request->fnacimiento;
            $espera->direccion= "sin dirección";
            $espera->telefono1= $request->telefono1;
            $espera->telefono2= $request->telefono2;
            $espera->email= $request->email;
            $espera->sexo= $request->sexo;
            $espera->fregistro= Carbon::now();
            $espera->admisione_id= $request->ingreso;
            $espera->carrera_id= $request->carrera;
            $espera->save();
            //enviamos el correo para avisar que se registro y esta a la espera
            $correo = new UserEsperaMailable;
            
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('home')->with('error','no se registro la solicitud correctamente');
        }
        Mail::to($espera->email)->send($correo);
        return Redirect::route('home')->with('info','revisa la bandeja de entrada de tu correo electrónico ... Registrado ');
    }
    public function bussines_store(EmpresaEsperaStoreRequest $request){
        try {
            //code...
            $esperaempresa = new Esperaempresa();
            $esperaempresa->ruc=$request->ruc;
            $esperaempresa->email=$request->email;
            $esperaempresa->contacto=$request->contacto;
            $esperaempresa->telefono1=$request->telefono1;
            $esperaempresa->telefono2=$request->telefono2;
            $esperaempresa->sectore_id=$request->sector;
            $esperaempresa->rubro_id=$request->rubro;
            $esperaempresa->save();
            $correo = new UserEsperaMailable;
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('home')->with('error','no se registro la solicitud correctamente');
        }
        Mail::to($esperaempresa->email)->send($correo);
        return Redirect::route('home')->with('info','se registro la solucitud correctamente');
    }
    public function userpdf($id){
        $user = User::findOrFail($id);
        $estudiantes = Estudiante::whereHas('postulante.cliente',function($query) use ($user){
            $query->where('idCliente','=',$user->ucliente->cliente_id);
        })->get();
        $nombre =  $user->ucliente->cliente->dniRuc;
        $pdf = Pdf::loadView('pdfs.hojavida',compact('user','estudiantes'));
        return $pdf->download($nombre.'.pdf');
        return view('pdfs.hojavida',compact('user','estudiantes'));
    }
}
