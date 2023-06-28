<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatepasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     */
    public $password1 = null;
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
            'old'=>['required',function($attribute,$value,$fail){
                $user = User::findOrFail(auth()->id());
                if(!Hash::check($value,$user->password))
                {
                    $fail('La contraseña es incorrecta');
                }
            }],
            'password1'=>['required','min:8',function($attribute,$value,$fail){
                $this->password1 = $value;
            }],
            'password2'=>['required','min:8',function($attribute,$value,$fail){
                 if($this->password1 != $value){
                    $fail('los password no coincides');
                 }
            }],
        ];
    }
}
