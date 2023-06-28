<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

trait MailTrait
{
    public function sendReset(Request $request)
    {
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Correo de restablecimiento de contraseña enviado']);
            //Queue::push(new SendResetPasswordEmail($request->email));
            
        } else {
            return response()->json(['message' => 'No se pudo enviar el correo de restablecimiento de contraseña'], 500);
        }
    }
    protected function broker()
    {
        return Password::broker();
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
}