<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleoStoreFrmRequest;
use App\Models\Carrera;
use App\Mail\AvisoMailable;
use App\Mail\RegistroMailable;
use App\Models\CarreraEmpleo;
use App\Models\Empleo;
use App\Models\Empleoturno;
use App\Models\Empresa;
use App\Models\Ubicacione;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use SplFileObject;

class EmpleoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:dashboard.empleos.index')->only('index');
        $this->middleware('can:dashboard.empleos.create')->only('create','store');
        $this->middleware('can:dashboard.empleos.edit')->only('edit','update');
        $this->middleware('can:dashboard.empleos.destroy')->only('destroy');
        $this->middleware('can:dashboard.empleos.show')->only('show');
    }
    public function index()
    {
        //si es un usuario Docente
        //rezamos si el usuario logeao es empresa o administrador
        if(auth()->user()->hasRole('Bolsa Empresa')){
            //es una empresa entonces solo le mostramos los empleos de su empresa
            //recuperamos la empresa relacionada al usuario;
            $empleos = Empleo::where('empresa_id','=',auth()->user()->uempresa->empresa_id)->orderBy('id','desc')->get();
        }
        if(auth()->user()->hasRole('Bolsa Administrador') || auth()->user()->hasRole('Docentes')){
            $empleos = Empleo::orderBy('id','desc')->get();
        }
        return view('dashboard.empleos.index',compact('empleos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //verificamos si el usuario tiene empresa
        //carreras;
        $carreras = Carrera::orderBy('nombreCarrera','asc')->where('ccarrera_id',"<>",null)->get();
        //dd($carreras);
        $empresas = Empresa::selectRaw('CONCAT(ruc," - ",razonSocial) AS Empresa, idEmpresa AS id')->pluck('Empresa','id')->toArray();
        $turnos = Empleoturno::pluck('nombre','id')->toArray();
        $ubicaciones = json_encode(Ubicacione::get()->toArray());
        return view('dashboard.empleos.create',compact('empresas','turnos','ubicaciones','carreras'));
        //return view('dashboard.empleos.test');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpleoStoreFrmRequest $request)
    {
        try {
            //code...
            //dd($request);
            DB::beginTransaction();
            if(isset($request->experiencia)){
                $experiencia = 1;
            }else{
                $experiencia = 0;
            }
            $empleo = new Empleo();
            $empleo->titulo=$request->titulo;
            $empleo->descripcion=$request->descripcion;
            $empleo->fecha_registro=Carbon::now();
            $empleo->fecha_postulacion=$request->cierre;
            $empleo->empresa_id=$request->empresa;
            $empleo->user_id=auth()->id();
            $empleo->experiencia=$experiencia;
            $empleo->empleoturno_id=$request->turno;
            $empleo->ubicacione_id=$request->distritos;
            $carpetaGuardado = 'img';
            // Obtenemos el archivo PDF
            $imgFile = $request->file('foto');
            // Generamos un nombre único para el archivo
            $nombreArchivo = uniqid() . '.' . $imgFile->getClientOriginalExtension();
            // Almacenamos el archivo en la carpeta especificada utilizando Storage::put()
            Storage::disk('public')->put($carpetaGuardado . '/' . $nombreArchivo, file_get_contents($imgFile));
            //vamos a poner la foto.
            $empleo->pic = $carpetaGuardado . '/' . $nombreArchivo;
            $empleo->save();
            $empleo->synccarreras($request->carreras);
            //vamos a guardar las carreras
            //ahora mandamos un correo a la empres para notificar el registro de la oferta
            DB::commit();
            //$correo = new RegistroMailable($empleo->id);
            //Mail::to($empleo->empresa->email)->send($correo);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $th->getMessage();
            return Redirect::route('dashboard.empleos.index')->with('error','Error al registrar el empleo, intente nuevamente');    
        }
        return Redirect::route('dashboard.empleos.index')->with('info','Se registro el empleo correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //mostrar postulantes al empleo
        $empleo = Empleo::findOrFail($id);
        return view('dashboard.empleos.show',compact('empleo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $carreras = Carrera::orderBy('nombreCarrera','asc')->where('ccarrera_id',"<>",null)->get();
        $empresas = Empresa::selectRaw('CONCAT(ruc," - ",razonSocial) AS Empresa, idEmpresa AS id')->pluck('Empresa','id')->toArray();
        $turnos = Empleoturno::pluck('nombre','id')->toArray();
        $ubicaciones = json_encode(Ubicacione::get()->toArray());
        $empleo = Empleo::findOrFail($id);
        return view('dashboard.empleos.edit',compact('empresas','turnos','ubicaciones','empleo','carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
       /*  $request->validate([
            'foto'=>'file|mimes:jpg,jpeg,png,gif|max:200',
        ]); */
        try {
            //code...
            $experiencia = null;
            if(isset($request->experiencia)){
                $experiencia = 1;
            }else{
                $experiencia = 0;
            }
            $empleo = Empleo::findOrFail($id);         
            $empleo->titulo=$request->titulo;
            $empleo->descripcion=$request->descripcion;
            $empleo->experiencia=$experiencia;
            $empleo->empleoturno_id=$request->empleoturno_id;
            $empleo->fecha_postulacion=$request->cierre;
            $empleo->ubicacione_id=$request->distritos;
            $carpetaGuardado = 'img';
            // Obtenemos el archivo PDF
           /*  $imgFile = $request->file('foto');
            // Generamos un nombre único para el archivo
            $nombreArchivo = uniqid() . '.' . $imgFile->getClientOriginalExtension();
            // Almacenamos el archivo en la carpeta especificada utilizando Storage::put()
            Storage::disk('public')->put($carpetaGuardado . '/' . $nombreArchivo, file_get_contents($imgFile));
            //vamos a poner la foto.
            $empleo->pic = $carpetaGuardado . '/' . $nombreArchivo; */
            $empleo->update();
            $empleo->synccarreras($request->carreras);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('dashboard.empleos.index')->with('error','no se pudo completar la accion de actualizacion');    
        }
        return Redirect::route('dashboard.empleos.index')->with('info','Se actualizo el empleo correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            //code...
            $empleo = Empleo::findOrFail($id);
            $empleo->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('dashboard.empleos.index')->with('error',$th->getMessage());  
        }
        return Redirect::route('dashboard.empleos.index')->with('info','Se elimino el empleo correctamente');
    }
    public function csv(Request $request){        
        $rows = 0;
        $cells = 0;
        $departamento = "";
        $provincia = "";
        $distrito = "";
        $ubigeo="";
        $idprovincia = 0;
        $iddepartamento = 0;
        $file = $request->file('file');
        $filePath = $file->getPathname();
        $fileObject = new SplFileObject($filePath, 'r');
        $fileObject->setFlags(SplFileObject::READ_CSV);
        $fileObject->setCsvControl(';');
        foreach ($fileObject as $row) {
        // $row es un array que contiene los datos de cada fila del archivo CSV
            $departamento =  $row[0];
            $provincia =  $row[1];
            $distrito =  $row[2];
            $ubigeo= $row[3];
            if($departamento != "" && $provincia == "" && $distrito == ""){
                $de = new Ubicacione;
                $de->nombre = $departamento;
                $de->ubigeo = $ubigeo;
                $de->save();
                $iddepartamento = $de->id;
                $rows ++;
            }else{
                if($departamento != "" && $provincia != "" && $distrito == ""){
                    //quiere decir que el distrito estavacio entonces es una provincia
                    $pro = new Ubicacione;
                    $pro->nombre = $provincia;
                    $pro->ubigeo = $ubigeo;
                    $pro->ubicacione_id = $iddepartamento;
                    $pro->save();
                    $idprovincia = $pro->id;
                    $rows ++;
                }else{
                    $dist = new Ubicacione;
                    $dist->nombre = $distrito;
                    $dist->ubigeo = $ubigeo;
                    $dist->ubicacione_id = $idprovincia;
                    $dist->save();
                    $rows ++;
                }
            
            }

        }
        dd($rows);
    }
}
