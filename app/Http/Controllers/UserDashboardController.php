<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Empleo;
use App\Models\Estudiante;
use App\Models\Postulacione;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        try {
            //code...
            $user = User::findOrFail(auth()->id());
            $carreras = Estudiante::whereHas('postulante.cliente',function($query) use($user){
                $query->where('idCliente','=',$user->ucliente->cliente_id);
            })->get();
            //dd($carreras[0]->postulante->carrera->idCarrera);
            //armamos el array con las carreras
            $array =[];
            foreach ($carreras as $carrera) {
                # code...
                if($carrera->postulante->carrera->ccarrera_id == null){
                    $car = Carrera::where('ccarrera_id','=',$carrera->postulante->carrera->idCarrera)->first();
                    array_push($array,$car->idCarrera);
                }else{
                    array_push($array,$carrera->postulante->carrera->idCarrera);
                }
            }
            $empleos = Empleo::whereHas('carreras',function($query) use($array){
                $query->whereIn('carrera_id',$array);
            })->orderBy('fecha_registro','desc')->get();
            $postulaciones = Postulacione::where('user_id','=',auth()->id())
            ->with([
                'empleo' => function($query){
                    $query->withTrashed();
                }
            ])->withTrashed()
            ->orderBy('fecha','desc')
            ->get();           

            return view('user_dashboard',compact('user','postulaciones','empleos'));
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('home');
        }
        
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
}
