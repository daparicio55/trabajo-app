<x-Modal :id="$docente->id.'-email'" title="Enviar/Actualizar Email" theme="warning" icon="fas fa-mail-bulk" send=true route="dashboard.administrador.updateemail" :parameter="$docente->id" method="post">
    <p>Ingrese el correo nuevo de o envie el correo de restablecimiento al correo actual</p>
    <label for="">Email</label>
    {!! Form::email('email', $docente->email, ['class'=>'form-control','required']) !!}
</x-Modal>