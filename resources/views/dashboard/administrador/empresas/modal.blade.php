<x-Modal :id="$empresa->idEmpresa.'-show'" title="Mostrando detalles" theme="info" icon="fas fa-eye">
    {!! Form::label('ruc', "RUC", [null]) !!}
    {!! Form::text('ruc', $empresa->ruc, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('razon', "Razon Social", [null]) !!}
    {!! Form::text('razon', $empresa->razonSocial, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('direccion', "Dirección", [null]) !!}
    {!! Form::text('direccion', $empresa->direccion, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('distrito', "Distrito", [null]) !!}
    {!! Form::text('distrito', $empresa->distrito, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('provincia', "Provincia", [null]) !!}
    {!! Form::text('provincia', $empresa->provincia, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('region', "Region", [null]) !!}
    {!! Form::text('region', $empresa->region, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('email', "Email", [null]) !!}
    {!! Form::email('email', $empresa->email, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('telefono1', "Telefono 1", [null]) !!}
    {!! Form::text('telefono1', $empresa->telefono1, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('telefono2', "Telefono 2", [null]) !!}
    {!! Form::text('telefono2', $empresa->telefono2, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('contacto1', "Contacto 1", [null]) !!}
    {!! Form::text('contacto1', $empresa->contacto1, ['class'=>'form-control','readonly']) !!}
    {!! Form::label('contacto2', "Contacto 2", [null]) !!}
    {!! Form::text('contacto2', $empresa->contacto2, ['class'=>'form-control','readonly']) !!}
    {{-- rubros y sector --}}
    {!! Form::label('sector', "Sector", [null]) !!}
    <select name="sector" class="form-control" disabled>
        <option value="0" >Seleccione</option>
        @foreach ($sectores as $sectore)
            <option value="{{ $sectore->id }}" @if($sectore->id == $empresa->sectore_id) selected @endif>{{ $sectore->nombre }}</option>            
        @endforeach
    </select>
    {!! Form::label('rubro', "Rubro", [null]) !!}
    <select name="rubro" class="form-control" disabled>
        <option value="0" >Seleccione</option>
        @foreach ($rubros as $rubro)
            <option value="{{ $rubro->id }}" @if($rubro->id == $empresa->rubro_id) selected @endif>{{ $rubro->nombre }}</option>            
        @endforeach
    </select>
    
</x-Modal>
<x-Modal :id="$empresa->idEmpresa.'-edit'" title="Editar Empresa" theme="success" icon="fas fa-user-edit" send=true route="dashboard.administrador.empresas.update" method="put" :parameter="$empresa->idEmpresa">
    {!! Form::label('ruc', "RUC", [null]) !!}
    {!! Form::text('ruc', $empresa->ruc, ['class'=>'form-control']) !!}
    {!! Form::label('razon', "Razon Social", [null]) !!}
    {!! Form::text('razon', $empresa->razonSocial, ['class'=>'form-control']) !!}
    {!! Form::label('direccion', "Dirección", [null]) !!}
    {!! Form::text('direccion', $empresa->direccion, ['class'=>'form-control']) !!}
    {!! Form::label('distrito', "Distrito", [null]) !!}
    {!! Form::text('distrito', $empresa->distrito, ['class'=>'form-control']) !!}
    {!! Form::label('provincia', "Provincia", [null]) !!}
    {!! Form::text('provincia', $empresa->provincia, ['class'=>'form-control']) !!}
    {!! Form::label('region', "Region", [null]) !!}
    {!! Form::text('region', $empresa->region, ['class'=>'form-control']) !!}
    {!! Form::label('email', "Email", [null]) !!}
    {!! Form::email('email', $empresa->email, ['class'=>'form-control']) !!}
    {!! Form::label('telefono1', "Telefono 1", [null]) !!}
    {!! Form::text('telefono1', $empresa->telefono1, ['class'=>'form-control']) !!}
    {!! Form::label('telefono2', "Telefono 2", [null]) !!}
    {!! Form::text('telefono2', $empresa->telefono2, ['class'=>'form-control']) !!}
    {!! Form::label('contacto1', "Contacto 1", [null]) !!}
    {!! Form::text('contacto1', $empresa->contacto1, ['class'=>'form-control']) !!}
    {!! Form::label('contacto2', "Contacto 2", [null]) !!}
    {!! Form::text('contacto2', $empresa->contacto2, ['class'=>'form-control']) !!}
    {{-- rubros y sector --}}
    {!! Form::label('sector', "Sector", [null]) !!}
    <select name="sector" class="form-control">
        <option value="0" >Seleccione</option>
        @foreach ($sectores as $sectore)
            <option value="{{ $sectore->id }}" @if($sectore->id == $empresa->sectore_id) selected @endif>{{ $sectore->nombre }}</option>            
        @endforeach
    </select>
    {!! Form::label('rubro', "Rubro", [null]) !!}
    <select name="rubro" class="form-control">
        <option value="0" >Seleccione</option>
        @foreach ($rubros as $rubro)
            <option value="{{ $rubro->id }}" @if($rubro->id == $empresa->rubro_id) selected @endif>{{ $rubro->nombre }}</option>            
        @endforeach
    </select>
    
</x-Modal>
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