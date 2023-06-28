<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaStoreRequest extends FormRequest
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
            'ruc'=>'required|min:11|max:11',
            'rubro'=>['required',function($attribute,$value,$fail){
                if($value==0){
                    $fail('debe elegir un rubro.');
                }
            }],
            'sector'=>[
                'required',
                function($attribute,$value,$fail){
                    if($value==0){
                        $fail('debe elegir un sector.');
                    }
                }
            ]
        ];
    }
}
