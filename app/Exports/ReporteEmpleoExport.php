<?php

namespace App\Exports;

use App\Models\Empleo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteEmpleoExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $criterio_empleo;
    protected $finicio_empleo;
    protected $ffin_empleo;
    public function __construct($string)
    {
        $data = explode(':',$string);
        $this->criterio_empleo = $data[0];
        $this->finicio_empleo = $data[1];
        $this->ffin_empleo = $data[2];
    }
    public function view() : View
    {
        $empleos = Empleo::orderBy('id','desc')
        ->whereBetween('fecha_registro',[$this->finicio_empleo,$this->ffin_empleo])
        ->where('titulo','like','%'.$this->criterio_empleo.'%')
        ->get();
        return view('exports.empleo-reporte',compact('empleos'));
    }
}