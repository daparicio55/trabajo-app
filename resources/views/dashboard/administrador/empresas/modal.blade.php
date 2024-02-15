<x-Modal :id="$empresa->idEmpresa.'-delete'" title="Eliminar Empresa" theme="danger" icon="far fa-trash-alt" send=true route="dashboard.administrador.empresas.destroy" method="delete" :parameter="$empresa->idEmpresa">
    <p>¿Esta seguro que desea elminar esta empresa del sistema?</p>
</x-Modal>
@isset($empresa->usuario[0]->id)
<x-Modal :id="$empresa->idEmpresa.'-email'" title="Enviar Correo de Reseteo" theme="warning" send=true route="password.email" method="post" >
    {!! Form::label('email', 'Correo Electronico', [null]) !!}
    {!! Form::text('email', $empresa->usuario[0]->email, ['class'=>'form-control','readonly']) !!}
</x-Modal>
@endif
<x-Modal :id="$empresa->idEmpresa.'-make'" title="Crear Cuenta de Empresa" theme="success" send=true route="dashboard.administrador.empresas.make">
    {!! Form::hidden('empresa', $empresa->idEmpresa, [null]) !!}
    {!! Form::label('email', 'Correo Electronico', [null]) !!}
    {!! Form::text('email', $empresa->email, ['class'=>'form-control', 'required' ]) !!}
</x-Modal>