<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleoStoreFrmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'empresa'=>'required',
            'titulo'=>'required',
            'descripcion'=>'required',
            'foto'=>'required|file|mimes:jpg,jpeg,png,gif|max:3500',
            'turno'=>'required',
            'cierre'=>'required',
            'carreras'=>'required',
            'departamentos'=>[
                'required',
                function($attribute,$value,$fail){
                    if($value == 0){
                        $fail('selecione un departamento');
                    }
                }
            ],
            'provincias'=>['required',function($attribute,$value,$fail){
                if($value == 0){
                    $fail('seleccione una provincia');
                }
            }],
            'distritos'=>['required',function($atrribute,$value,$fail){
                if($value == 0){
                    $fail('seleccione un distrito');
                }
            }],
            //
        ];
    }
}
