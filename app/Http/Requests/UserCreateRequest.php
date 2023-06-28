<?php

namespace App\Http\Requests;

use App\Models\Estudiante;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //verificamos si el dni ya esta registrado como estudiante
        /* $dni = $this->input('dniRuc');
        $estudiante = Estudiante::whereHas('postulante.cliente',function($query) use($dni){
            $query->where('dniRuc','=',$dni);
        })->get();
        if(isset($estudiante)){
            return true;
        } */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dniRuc'=>[
                'required',
                function($attribute,$value,$fail){
                    $estudiante = Estudiante::whereHas('postulante.cliente',function($query) use($value){
                        $query->where('dniRuc','=',$value);
                    })->first();
                    if(isset($estudiante->id)){
                        $fail('ya existe ese dni como estudiante');
                    }
                }
            ],
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required',
            'fnacimiento'=>'required',
            'telefono1'=>'required|digits:9',
            'sexo'=>[
                'required',
                function($attribute,$value,$fail){
                    if(!($value == 'Masculino') && !($value == 'Femenino')){
                        $fail('campo requerido');
                    }
                }
            ],
            'carrera'=>[
                'required',
                function($attribute,$value,$fail){
                    if($value == 0){
                        $fail('campo requerido');
                    }
                }
            ],
            'ingreso'=>[
                'required',
                function($attribute,$value,$fail){
                    if($value == 0){
                        $fail('campo requerido');
                    }
                }
            ]
        ];
    }
}
