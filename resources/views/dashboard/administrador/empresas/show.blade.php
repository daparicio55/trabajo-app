{{-- <x-Modal :id="$empresa->idEmpresa.'-show'" title="Mostrando detalles" theme="info" icon="fas fa-eye">
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
</x-Modal> --}}


@extends('adminlte::page')

@section('title', 'Mostrar Empresa')

@section('content_header')
    <h1>Mostrar Empresa</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header bg bg-info">
            <a href="{{ route('dashboard.administrador.empresas.index') }}" class="btn btn-danger">
                <i class="fas fa-backward" title="regresar"></i>
            </a> 
                <h4 class="d-inline p-2">Datos</h4>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-10">
                    {!! Form::label('ruc', "RUC", [null]) !!}
                    {!! Form::number('ruc', $empresa->ruc, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('razon', "Razon Social", ['class'=>'d-block']) !!}
                    {!! Form::text('razon', $empresa->razonSocial, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('direccion', "Dirección", [null]) !!}
                    {!! Form::text('direccion', $empresa->direccion, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('distrito', "Distrito", [null]) !!}
                    {!! Form::text('distrito', $empresa->distrito, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('provincia', "Provincia", [null]) !!}
                    {!! Form::text('provincia', $empresa->provincia, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('region', "Region", [null]) !!}
                    {!! Form::text('region', $empresa->region, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('email', "Email", [null]) !!}
                    {!! Form::email('email', $empresa->email, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('telefono1', "Telefono 1", [null]) !!}
                    {!! Form::text('telefono1', $empresa->telefono1, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('telefono2', "Telefono 2", [null]) !!}
                    {!! Form::text('telefono2', $empresa->telefono2, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('contacto1', "Contacto 1", [null]) !!}
                    {!! Form::text('contacto1', $empresa->contacto1, ['class'=>'form-control','readonly'=>'true']) !!}
                    {!! Form::label('contacto2', "Contacto 2", [null]) !!}
                    {!! Form::text('contacto2', $empresa->contacto2, ['class'=>'form-control','readonly'=>'true']) !!}
                    <!--- sectores -->
                    {!! Form::label('sectores', "Sector", ['class'=>'mt-3']) !!}
                    <select name="sector" id="sector" class="form-control mt-2" disabled>
                        <option value="0" >Seleccione</option>
                        @foreach ($sectores as $sectore)
                            <option value="{{ $sectore->id }}" @if($sectore->id == $empresa->sectore_id) selected @endif>{{ $sectore->nombre }}</option>            
                        @endforeach
                    </select>
                    {{-- rubros y sector --}}
                    {!! Form::label('rubros', "Rubro", ['class'=>'mt-3']) !!}
                    <select name="rubro" id="rubro" class="form-control mt-2" disabled>
                        <option value="0" >Seleccione</option>
                        @foreach ($rubros as $rubro)
                            <option value="{{ $rubro->id }}" @if($rubro->id == $empresa->rubro_id) selected @endif >{{ $rubro->nombre }}</option>            
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@stop