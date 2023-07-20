<?php

namespace App\Http\Controllers;

use App\Models\Rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:dashboard.administrador.rubros.index')->only('index');
        $this->middleware('can:dashboard.administrador.rubros.create')->only('create','store');
        $this->middleware('can:dashboard.administrador.rubros.edit')->only('edit','update');
        $this->middleware('can:dashboard.administrador.rubros.destroy')->only('destroy');
        $this->middleware('can:dashboard.administrador.rubros.show')->only('show');
    }
    public function index()
    {
        //
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
        try {
            //code...
            $rubro = new Rubro();
            $rubro->nombre = $request->nombre;
            $rubro->save();
            //ahora devolvemos los datos del rubro
        } catch (\Throwable $th) {
            //throw $th;
            $array = ["respuesta"=>'error no se guardo'];
            return json_encode($array);
        }
        $array = ["respuesta"=>'rubro guardado'];
        return json_encode($rubro);
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
