{{-- <x-Modal :id="$estudiante->id.'-email'" title="Enviar/Actualizar Email" theme="warning" icon="fas fa-mail-bulk" send=true route="dashboard.administrador.updateemail" :parameter="$estudiante->id" method="post">
    <p>Ingrese el correo nuevo de o envie el correo de restablecimiento al correo actual</p>
    <label for="">Email</label>
    @isset($estudiante->postulante->cliente->ucliente->user_id)
        {!! Form::email('email', $estudiante->postulante->cliente->ucliente->user->email, ['class'=>'form-control','required']) !!}
    @endisset
</x-Modal>
<x-Modal :id="$estudiante->id.'-create'" title="Crear cuenta a a estudiante" theme="primary" icon="fas fa-id-card" send=true route="dashboard.administrador.makeaccount" :parameter="$estudiante->id" method="get">
    <p>Se creara la cuenta para el estudiante y se envia la informacion al siguiente correo.</p>
    <label for="">Email</label>
    {!! Form::email('email', $estudiante->postulante->cliente->email, ['class'=>'form-control','required']) !!}
</x-Modal> --}}
<form action="{{ route('dashboard.administrador.makeaccount') }}" method="post" id="form-crear">
    @csrf
    <div class="modal fade" id="modal-crear" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">
                        <i class="fas fa-mail-bulk"></i> Crear cuenta de estudiante ...
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Ingrese el correo nuevo de o envie el correo de restablecimiento al correo actual registrado.
                    </p>
                    <label for="email">
                        Email
                    </label>
                    <input type="email" name="email" id="email_crear" class="form-control" required>
                    <input type="text" name="estudiante_id_crear" id="estudiante_id" class="form-control" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-paper-plane"></i> Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>




<form action="{{ route('dashboard.administrador.updateemail') }}" method="post" id="form-email">
    @csrf
    <div class="modal fade" id="modal-email" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">
                        <i class="fas fa-mail-bulk"></i> Enviar/Actualizar Email
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Ingrese el correo nuevo o envie el correo de restablecimiento al correo actual registrado.
                    </p>
                    <label for="email">
                        Email
                    </label>
                    <input type="email" name="email" id="email_actualizar" class="form-control" required>
                    <input type="text" name="estudiante_id" id="estudiante_id_email" class="form-control" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-paper-plane"></i> Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>