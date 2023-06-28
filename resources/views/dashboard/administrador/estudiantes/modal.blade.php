<x-Modal :id="$estudiante->id.'-email'" title="Enviar/Actualizar Email" theme="warning" icon="fas fa-mail-bulk" send=true route="dashboard.administrador.updateemail" :parameter="$estudiante->id" method="post">
    <p>Ingrese el correo nuevo de o envie el correo de restablecimiento al correo actual</p>
    <label for="">Email</label>
    @isset($estudiante->postulante->cliente->ucliente->user_id)
        {!! Form::email('email', $estudiante->postulante->cliente->ucliente->user->email, ['class'=>'form-control','required']) !!}
    @endisset
</x-Modal>
<x-Modal :id="$estudiante->id.'-create'" title="Crear cuenta a a estudiante" theme="primary" icon="fas fa-id-card" send=true route="dashboard.administrador.makeaccount" :parameter="$estudiante->id" method="get">
    <p>Se creara la cuenta para el estudiante y se envia la informacion al siguiente correo.</p>
    <label for="">Email</label>
    {!! Form::email('email', $estudiante->postulante->cliente->email, ['class'=>'form-control','required','readonly']) !!}
</x-Modal>