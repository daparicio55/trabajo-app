<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleoStoreFrmRequest;
use App\Models\Empleo;
use App\Models\Empleoturno;
use App\Models\Empresa;
use App\Models\Ubicacione;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        //
        //rezamos si el usuario logeao es empresa o administrador
        if(auth()->user()->hasRole('Bolsa Empresa')){
            //es una empresa entonces solo le mostramos los empleos de su empresa
            //recuperamos la empresa relacionada al usuario;
            $empleos = Empleo::where('empresa_id','=',auth()->user()->uempresa->empresa_id)->orderBy('fecha_registro','desc')->get();
        }
        if(auth()->user()->hasRole('Bolsa Administrador')){
            $empleos = Empleo::orderBy('fecha_registro','desc')->get();
        }
        return view('dashboard.empleos.index',compact('empleos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        $empresas = Empresa::selectRaw('CONCAT(ruc," - ",razonSocial) AS Empresa, idEmpresa AS id')->pluck('Empresa','id')->toArray();
        $turnos = Empleoturno::pluck('nombre','id')->toArray();
        $ubicaciones = json_encode(Ubicacione::get()->toArray());
        return view('dashboard.empleos.create',compact('empresas','turnos','ubicaciones'));
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
            $empleo->save();

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('dashboard.empleos.index')->with('error',$th->getMessage());    
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
        $empresas = Empresa::selectRaw('CONCAT(ruc," - ",razonSocial) AS Empresa, idEmpresa AS id')->pluck('Empresa','id')->toArray();
        $turnos = Empleoturno::pluck('nombre','id')->toArray();
        $ubicaciones = json_encode(Ubicacione::get()->toArray());
        $empleo = Empleo::findOrFail($id);
        return view('dashboard.empleos.edit',compact('empresas','turnos','ubicaciones','empleo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
            $empleo->fecha_postulacion=$request->fecha_postulacion;
            $empleo->ubicacione_id=$request->distritos;
            $empleo->update();

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('dashboard.empleos.index')->with('error',$th->getMessage());    
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
