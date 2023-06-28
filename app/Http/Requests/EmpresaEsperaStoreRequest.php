<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class EmpresaEsperaStoreRequest extends FormRequest
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
            //
            'ruc'=>['required','min:11','max:11',function($attribute,$value,$fail){
                    $empresa = Empresa::where('ruc','=',$value)->first();
                    if(isset($empresa->idEmpresa)){
                        $fail('el ruc ya se encuentra registrado en el sistema');
                    }
                }],
            'email'=>['required',function($attribute,$value,$fail){
                $user = User::where('email','=',$value)->first();
                if (isset($user->id)){
                    $fail('el email ya existe en el sistema');
                }
            }],
            'contacto'=>'required',
            'telefono1'=>'required',
            'telefono2'=>'required',
            'sector'=>['required',function($attribute,$value,$fail){
                if($value == 0){
                    $fail('debe elegir un sector');
                }
            }],
            'rubro'=>['required',function($attribute,$value,$fail){
                if($value == 0){
                    $fail('debe elegir un rubro');
                }
            }]
        ];
    }
}
