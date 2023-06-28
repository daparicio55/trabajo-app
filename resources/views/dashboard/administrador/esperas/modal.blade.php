<x-Modal :id="$espera->id" title="Detalles del Registro" theme="primary" icon="fas fa-list">
    {!! Form::label(null, 'Fecha nacimiento', [null]) !!}
    {!! Form::date(null, $espera->fnacimiento, ['class'=>'form-control', 'readonly']) !!}
    {!! Form::label(null, 'Telefono 1', [null]) !!}
    {!! Form::text(null, $espera->telefono1, ['class'=>'form-control', 'readonly']) !!}
    {!! Form::label(null, 'Telefono 2', [null]) !!}
    {!! Form::text(null, $espera->telefono2, ['class'=>'form-control', 'readonly']) !!}
    {!! Form::label(null, 'Email', [null]) !!}
    {!! Form::text(null, $espera->email, ['class'=>'form-control', 'readonly']) !!}
    {!! Form::label(null, 'Sexo', [null]) !!}
    {!! Form::text(null, $espera->sexo, ['class'=>'form-control', 'readonly']) !!}
</x-Modal>

<x-Modal :id="$espera->id.'-aceptar'" title="Aceptar registro de estudiante" theme="warning" icon="far fa-check-circle" send=true route="dashboard.administrador.esperas.store" method="post"> 
    {!! Form::hidden('espera', $espera->id, [null]) !!}
    {!! Form::label('dni', 'DNI', [null]) !!}
    {!! Form::text('dni', $espera->dniRuc, ['class'=>'form-control', 'required']) !!}
    {!! Form::label('apellido', 'APELLIDOS', [null]) !!}
    {!! Form::text('apellido', $espera->apellido, ['class'=>'form-control', 'required']) !!}
    {!! Form::label('nombre', 'Nombres', [null]) !!}
    {!! Form::text('nombre', $espera->nombre, ['class'=>'form-control', 'required']) !!}
    {!! Form::label('nacimiento', 'Fecha nacimiento', [null]) !!}
    {!! Form::date('nacimiento', $espera->fnacimiento, ['class'=>'form-control', 'required']) !!}
    {!! Form::label('telefono1', 'Telefono 1', [null]) !!}
    {!! Form::text('telefono1', $espera->telefono1, ['class'=>'form-control', 'required']) !!}
    {!! Form::label('telefono2', 'Telefono 2', [null]) !!}
    {!! Form::text('telefono2', $espera->telefono2, ['class'=>'form-control', 'required']) !!}
    {!! Form::label('email', 'Email', [null]) !!}
    {!! Form::text('email', $espera->email, ['class'=>'form-control', 'required']) !!}
    {!! Form::label('sexo', 'Sexo', [null]) !!}
    {!! Form::select('sexo', $sexos, $espera->sexo, ['class'=>'form-control']) !!}
    {!! Form::label('periodo', 'Periodo ingreso', [null]) !!}
    {!! Form::select('periodo', $admisiones, $espera->admisione_id, ['class'=>'form-control']) !!}
    {!! Form::label('programa', 'Programa de estudios', [null]) !!}
    {!! Form::select('programa', $programas, $espera->carrera_id, ['class'=>'form-control']) !!}
</x-Modal>

<x-Modal :id="$espera->id.'-eliminar'" title="Eliminar Registro" theme="danger" icon="far fa-trash-alt" send=true route="dashboard.administrador.esperas.destroy" method="delete" :parameter="$espera->id">
<p>¿Esta seguro que desea elminar este registro?</p>
</x-Modal>