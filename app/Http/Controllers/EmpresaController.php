<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaStoreRequest;
use App\Models\Empresa;
use App\Models\Esperaempresa;
use App\Models\Oficina;
use App\Models\Rubro;
use App\Models\Sectore;
use App\Models\Uempresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Traits\MailTrait;

class EmpresaController extends Controller
{
    use MailTrait;
    
    /**
     * Display a listing of the resource.
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:dashboard.administrador.empresas.index')->only('index');
        $this->middleware('can:dashboard.administrador.empresas.create')->only('create','store');
        $this->middleware('can:dashboard.administrador.empresas.edit')->only('edit','update');
        $this->middleware('can:dashboard.administrador.empresas.show')->only('show');
        $this->middleware('can:dashboard.administrador.empresas.destroy')->only('destroy');
        $this->middleware('can:dashboard.administrador.empresas.showwaitings')->only('showwaitings');
        $this->middleware('can:dashboard.administrador.empresas.make')->only('make');
        $this->middleware('can:dashboard.administrador.empresas.getruc')->only('getRuc');
    }
    public function index()
    {
        //
        $empresas = Empresa::get();
        $rubros = Rubro::get();
        $sectores = Sectore::get();
        return view('dashboard.administrador.empresas.index',compact('empresas','rubros','sectores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $rubros = Rubro::get();
        $sectores = Sectore::get();
        return view('dashboard.administrador.empresas.create',compact('rubros','sectores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaStoreRequest $request)
    {
        //
        try {
            //code...
            $empresa = new Empresa();
            $empresa->ruc=$request->ruc;
            $empresa->razonSocial=$request->razon;
            $empresa->direccion=$request->direccion;
            $empresa->distrito=$request->distrito;
            $empresa->provincia=$request->provincia;
            $empresa->region=$request->region;
            $empresa->telefono1=$request->telefono1;
            $empresa->telefono2=$request->telefono2;
            $empresa->contacto1=$request->contacto1;
            $empresa->contacto2=$request->contacto2;
            $empresa->rubro_id=$request->rubro;
            $empresa->sectore_id=$request->sector;
            $empresa->email=$request->email;
            $empresa->save();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('dashboard.administrador.empresas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('dashboard.administrador.empresas.index')->with('info','se guardo la informacion de la empresa correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $rubros = Rubro::get();
        $sectores = Sectore::get();
        $empresa = Empresa::findOrFail($id);
        return view('dashboard.administrador.empresas.show',compact('empresa','rubros','sectores'));
    }
    public function showwaitings(){
        //mostar empresas en espera.
        $esperas = Esperaempresa::get();
        $rubros = Rubro::pluck('nombre','id')->toArray();
        $sectores = Sectore::pluck('nombre','id')->toArray();
        return view("dashboard.administrador.empresas.esperas",compact('esperas','rubros','sectores'));
    }
    public function storewaiting(Request $request){
        
        try {
            //code...
            DB::beginTransaction();
            $empresa = new Empresa();
            $empresa->ruc = $request->ruc;
            $empresa->razonSocial = $request->razon;
            $empresa->direccion = $request->direccion;
            $empresa->distrito = $request->distrito;
            $empresa->provincia = $request->provincia;
            $empresa->region = $request->region;
            $empresa->telefono1 = $request->telefono1;
            $empresa->telefono2 = $request->telefono2;
            $empresa->contacto1 = $request->contacto1;
            $empresa->contacto2 = $request->contacto2;
            $empresa->email= $request->email;
            $empresa->rubro_id = $request->rubro;
            $empresa->sectore_id = $request->sector;
            $empresa->save();
            //ahora borramos el registro en espera:
            Esperaempresa::findOrFail($request->espera)->delete();
            //empresa
            $oficina = Oficina::where('nombre','=','Empresa')->first();
            //ahora crea mos usuario en el sistema
            $user = new User();
            $user->name = $request->razon;
            $user->email = $request->email;
            $user->idOficina = $oficina->idOficina;
            $user->password = bcrypt('Pj'.$empresa->ruc);
            $user->save();
            //le damos permiso de empresa
            $user->assignRole('Bolsa Empresa');
            //ahora creamos la empresa
            $uempresa  = new Uempresa();
            $uempresa->user_id = $user->id;
            $uempresa->empresa_id = $empresa->idEmpresa;
            $uempresa->save();
            DB::commit();
            
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
            return Redirect::route('dashboard.administrador.empresas.showwaitings')->with('error',$th->getMessage());
        }
        //ENVIAR CORREO DE RECUPERACION
        $this->sendReset($request);
        return Redirect::route('dashboard.administrador.empresas.showwaitings')->with('info','se registro correctamente la empresa en el sistema');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $rubros = Rubro::get();
        $sectores = Sectore::get();
        $empresa = Empresa::findOrFail($id);
        return view('dashboard.administrador.empresas.edit',compact('empresa','rubros','sectores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            DB::beginTransaction();
            $empresa = Empresa::findOrFail($id);
/*             $empresa->ruc = $request->ruc; */
            $empresa->razonSocial = $request->razon;
            $empresa->direccion = $request->direccion;
            $empresa->distrito = $request->distrito;
            $empresa->provincia = $request->provincia;
            $empresa->region = $request->region;
            $empresa->telefono1 = $request->telefono1;
            $empresa->telefono2 = $request->telefono2;
            $empresa->contacto1 = $request->contacto1;
            $empresa->contacto2 = $request->contacto2;
            $empresa->email= $request->email;
            $empresa->rubro_id = $request->rubro;
            $empresa->sectore_id = $request->sector;
            $empresa->update();
            //cambiar los datos del usuario de u_empresas
            $user = User::findOrFail($empresa->usuario[0]->id);
            $user->email = $request->email;
            $user->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
            return Redirect::route('dashboard.administrador.empresas.index')->with('error','se producio un error cuando se intento actualizar la empresa');
        }
        return Redirect::route('dashboard.administrador.empresas.index')->with('info','se edito correctamente la empresa en el sistema');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            //code...
            Empresa::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('dashboard.administrador.empresas.index')->with('error','se producio un error cuando se intento eliminar la empresa');
        }
        return Redirect::route('dashboard.administrador.empresas.index')->with('info','se elimino correctamente la empresa en el sistema');
    }
    public function deletewaitings($id){
        try {
            //code...
            $empresaespera = Esperaempresa::findOrFail($id);
            $empresaespera->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('dashboard.administrador.empresas.showwaitings')->with('error',"no se logro borrar la espera");
        }
        return Redirect::route('dashboard.administrador.empresas.showwaitings')->with('info','el registro se elimino correctamente la empresa en espera');
    }
    public function getRuc(Request $request){
        try {
            $url = "https://dniruc.apisperu.com/api/v1/ruc/" . $request->ruc . "?token=" .env("APIPERUTOKEN");
            $consulta = file_get_contents($url);
            $consulta=json_encode($consulta);
            return $consulta;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
        
    }
    public function make(Request $request){
        try {
            DB::beginTransaction();
            //code...
            //tenemos que actualizar el correo de la empresa por si cambio
            $empresa = Empresa::findOrFail($request->empresa);
            $empresa->email = $request->email;
            $empresa->update();
            //ahora creamos el usuario;
            $user = new User();
            $user->name = $empresa->razonSocial;
            $user->email = $empresa->email;
            $user->password = bcrypt("Pj".$request->ruc);
            $user->idOficina = 11;
            $user->save();
            $user->assignRole('Bolsa Empresa');
            $uempresa = new Uempresa();
            $uempresa->user_id = $user->id;
            $uempresa->empresa_id = $empresa->idEmpresa;
            $uempresa->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
            return Redirect::route('dashboard.administrador.empresas.index')->with('error','no se registro a la empresa como usuario');
        }
        return Redirect::route('dashboard.administrador.empresas.index')->with('info','se registro la empresa como usuario correctamente, envie el correo de recuperacion a la empresa');
    }
}
