<x-Modal :id="$espera->id.'-show'" title="Mostrando detalles" theme="info" icon="fas fa-eye">
{!! Form::label('ruc', "RUC", [null]) !!}
{!! Form::text('ruc', $espera->ruc, ['class'=>'form-control']) !!}
{!! Form::label('contacto', 'Contacto', [null]) !!}
{!! Form::text('contacto', $espera->contacto, ['class'=>'form-control']) !!}
{!! Form::label('email', 'Email', [null]) !!}
{!! Form::text('email', $espera->email, ['class'=>'form-control']) !!}
{!! Form::label('telefono1', "Telefono 1", [null]) !!}
{!! Form::text('telefono1', $espera->telefono1, ['class'=>'form-control']) !!}
{!! Form::label('telefono2', 'Telefono 2', [null]) !!}
{!! Form::text('telefono2', $espera->telefono2, ['class'=>'form-control']) !!}
{!! Form::label('sector', 'Sector', [null]) !!}
{!! Form::text('sector', $espera->sectore->nombre, ['class'=>'form-control']) !!}
{!! Form::label('rubro', 'Rubro', [null]) !!}
{!! Form::text('rubro', $espera->rubro->nombre, ['class'=>'form-control']) !!}

</x-Modal>
<x-Modal :id="$espera->id.'-aceptar'" title="Aceptar registro de empresa" theme="warning" icon="far fa-check-circle" send=true route="dashboard.administrador.empresas.storewaiting" method="post"> 
    {!! Form::hidden('espera', $espera->id, [null]) !!}
    {!! Form::label('ruc', "RUC", [null]) !!}
    <button class="btn btn-info ml-2 btn-sm" id="btn_search">
        <i class="fas fa-search"></i>
    </button>
    {!! Form::text('ruc', $espera->ruc, ['class'=>'form-control mt-1']) !!}
    {!! Form::label('contacto', 'Contacto', [null]) !!}
    {!! Form::text('contacto', $espera->contacto, ['class'=>'form-control']) !!}
    {!! Form::label('email', 'Email', [null]) !!}
    {!! Form::text('email', $espera->email, ['class'=>'form-control']) !!}
    {!! Form::label('razon', "Razon Social", ['class'=>'d-block']) !!}
    {!! Form::text('razon', null, ['class'=>'form-control']) !!}
    @error('razon')
        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
    @enderror
    {!! Form::label('direccion', "Dirección", [null]) !!}
    {!! Form::text('direccion', null, ['class'=>'form-control']) !!}
    @error('direccion')
        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
    @enderror
    {!! Form::label('distrito', "Distrito", [null]) !!}
    {!! Form::text('distrito', null, ['class'=>'form-control']) !!}
    @error('distrito')
        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
    @enderror
    {!! Form::label('provincia', "Provincia", [null]) !!}
    {!! Form::text('provincia', null, ['class'=>'form-control']) !!}
    @error('provincia')
        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
    @enderror
    {!! Form::label('region', "Region", [null]) !!}
    {!! Form::text('region', null, ['class'=>'form-control']) !!}
    @error('region')
        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
    @enderror
    {!! Form::label('telefono1', "Telefono 1", [null]) !!}
    {!! Form::text('telefono1', $espera->telefono1, ['class'=>'form-control']) !!}
    {!! Form::label('telefono2', 'Telefono 2', [null]) !!}
    {!! Form::text('telefono2', $espera->telefono2, ['class'=>'form-control']) !!}
    {!! Form::label('sector', 'Sector', [null]) !!}
    {!! Form::select('sector', $sectores, $espera->sectore_id, ['class'=>'form-control']) !!}
    {!! Form::label('rubro', 'Rubro', [null]) !!}
    {!! Form::select('rubro', $rubros, $espera->rubro_id, ['class'=>'form-control']) !!}

</x-Modal>
<x-Modal :id="$espera->id.'-eliminar'" title="Eliminar Registro" theme="danger" icon="far fa-trash-alt" send=true route="dashboard.administrador.empresas.destroywaitings" method="delete" :parameter="$espera->id">
    <p>¿Esta seguro que desea elminar este registro?</p>
</x-Modal>