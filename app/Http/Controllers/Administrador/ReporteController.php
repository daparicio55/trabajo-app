<?php

namespace App\Http\Controllers\Administrador;

use App\Exports\ReporteEmpleoExport;
use App\Exports\ReportePostulacioneExport;
use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Empleo;
use App\Models\Postulacione;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:dashboard.administrador.reportes.index')->only('index');
    }
    public function index()
    {
        //
        return view('dashboard.administrador.reportes.index');
    }
    public function index2()
    {
        $carreras = Carrera::where('observacionCarrera', 'visible')->get();
        return view('dashboard.administrador.reportes.index2', compact('carreras'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function reporte_empleo(Request $request)
    {
        $carreras = Carrera::where('observacionCarrera', 'visible')->get();
        //validamos el formulario
        $request->validate([
            'finicio_empleo' => 'required',
            'ffin_empleo' => 'required|date|after_or_equal:finicio_empleo'
        ]);
        //ya esta la validacion
        $empleos = Empleo::orderBy('id', 'desc')
            ->whereBetween('fecha_registro', [$request->finicio_empleo, $request->ffin_empleo])
            ->where('titulo', 'like', '%' . $request->criterio_empleo . '%')
            ->get();
        return view('dashboard.administrador.reportes.index', compact('empleos', 'carreras'));
    }
    public function reporte_postulaciones(Request $request)
    {
        $request->validate([
            'finicio_postulaciones' => 'required',
            'ffin_postulaciones' => 'required|date|after_or_equal:finicio_postulaciones'
        ]);

        if ($request->carrera_id != 0) {
            $carrera = Carrera::find($request->carrera_id);

            $postulaciones = Postulacione::whereHas('user.ucliente.cliente.postulaciones', function ($query) use ($carrera) {
                $query->whereIn('idCarrera', $carrera->arrayIds());
            })
                ->whereBetween('fecha', [$request->finicio_postulaciones, $request->ffin_postulaciones])
                ->with(['empleo' => function ($query) {
                    $query->withTrashed();
                }])
                ->withTrashed()
                ->get();
        } else {
            $postulaciones = Postulacione::whereBetween('fecha', [$request->finicio_postulaciones, $request->ffin_postulaciones])
                ->with(['empleo' => function ($query) {
                    $query->withTrashed();
                }])
                ->withTrashed()
                ->get();
        }

        $carreras = Carrera::where('observacionCarrera', 'visible')->get();
        return view('dashboard.administrador.reportes.index2', compact('postulaciones', 'carreras'));
    }
    public function reporte_postulaciones_excel($string)
    {
        $file = str_replace(':', '-', $string);
        return Excel::download(new ReportePostulacioneExport($string), $file . '.xlsx');
    }
    public function reporte_empleo_excel($string)
    {
        $file = str_replace(':', '-', $string);
        return Excel::download(new ReporteEmpleoExport($string), $file . '.xlsx');
    }
}
