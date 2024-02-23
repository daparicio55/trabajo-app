<?php

namespace App\Http\Controllers;

use App\Mail\AvisoMailable;
use App\Mail\NoticeMailable;
use App\Models\Empleo;
use App\Models\Postulacione;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PostulacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:dashboard.postulaciones.index')->only('index');
        $this->middleware('can:dashboard.postulaciones.destroy')->only('destroy');
    }
    public function index()
    {
        //mostramos nuestas postulaciones
        $postulaciones = Postulacione::where('user_id','=',auth()->id())->get();
        return view('dashboard.user.index',compact('postulaciones'));
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
        try {
            //code...
            if($this->propiedad($id) == false){
                return Redirect::route('dashboard.postulaciones.index')->with('error','no se puede borrar esta postulacion');
            }
            $postulacione = Postulacione::findOrFail($id);
            $postulacione->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('user_dashboard.index')->with('error','no se puede borrar esta postulacion');
        }
        return Redirect::route('user_dashboard.index')->with('info','la postulacion se elimino correctamente');
    }
    public function postular($id){
        //verificamos si es un estudiante
        if(auth()->user()->hasRole('Bolsa User')){
            //logica para grabar su postulacion
            $empleo = Empleo::findOrFail($id);
            $f_empleo = Carbon::parse($empleo->fecha_postulacion);
            $f_hoy = Carbon::parse(date('Y-m-d',strtotime(Carbon::now())));
            if($f_hoy->gt($f_empleo)){
                return Redirect::route('home')->with('error','la oferta laboral esta cerrada');
            }
            try {
                //code...
                $postulacione = new Postulacione();
                $postulacione->fecha = Carbon::now();
                $postulacione->user_id = auth()->id();
                $postulacione->empleo_id = $id;
                $postulacione->save();
            } catch (\Throwable $th) {
                //throw $th;
                return Redirect::route('home')->with('error','no se pudo registrar tu postulacion, asegurate de no tener una postulacion activa a este empleo');
                //return Redirect::route('home')->with('error',$th->getMessage());
            }

            $email = new NoticeMailable($postulacione->id);
            $correo = new AvisoMailable($postulacione->id);
            //enviar correos de postulacion.
            Mail::to($postulacione->empleo->empresa->email)->send($correo);
            Mail::to(auth()->user()->email)->send($email);

            return Redirect::route('user_dashboard.index')->with('info','tu postulacion se registro correctamente');
        }else{
            return Redirect::route('user_dashboard.index')->with('error','tu usuario no puedo postular a un puesto');
        }
    }
    public function propiedad($id) : bool
    {
        //verificamos si el $id le pertenece al usuario
        $cantidad = Postulacione::where('user_id','=',auth()->id())->where('id','=',$id)->count();
        if($cantidad>0){
            return true;
        }else{
            return false;
        }
    }
}
