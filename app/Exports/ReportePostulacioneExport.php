<?php

namespace App\Exports;

use App\Models\Postulacione;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ReportePostulacioneExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $carrera_id;
    protected $finicio_postulaciones;
    protected $ffin_postulaciones;
    public function __construct($string)
    {
        $data = explode(':',$string);
        $this->carrera_id = $data[0];
        $this->finicio_postulaciones = $data[1];
        $this->ffin_postulaciones = $data[2];
    }
    public function view() : View
    {        
        $postulaciones = Postulacione::whereHas('user.ucliente.cliente.postulaciones',function($query){
            $query->where('idCarrera','=',$this->carrera_id);
        })->whereBetween('fecha',[$this->finicio_postulaciones,$this->ffin_postulaciones])->get();
        return view('exports.postulaciones-reporte',compact('postulaciones'));
    }
}
