@extends('adminlte::page')

@section('title', 'Edit Profile')

@section('content_header')
    
@stop

@section('content')
{!! Form::open(['route'=>['dashboard.settings.update',$user->id],'method'=>'put']) !!}
    <div class="container">
        <div class="card mt-3">
            <div class="card-header bg-info">
                <div class="card-title">
                    <h4>Editar Perfil</h4>
                </div>
            </div>
            <div class="card-body">
                {!! Form::label('name', 'Nombres y Apellidos', [null]) !!}
                {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
                {!! Form::label('telefono1', 'Telefono 1', ['class'=>'mt-2']) !!}
                {!! Form::text('telefono1', $user->ucliente->cliente->telefono, ['class'=>'form-control']) !!}
                {!! Form::label('telefono2', 'Telefono 2', ['class'=>'mt-2']) !!}
                {!! Form::text('telefono2', $user->ucliente->cliente->telefono2, ['class'=>'form-control']) !!}
                {!! Form::label('direccion', 'Direccion', ['class'=>'mt-2']) !!}
                {!! Form::text('direccion', $user->ucliente->cliente->direccion, ['class'=>'form-control']) !!}
                {!! Form::label(null, 'Postulaciones', ['class'=>'mt-2']) !!}
                @php
                    $nacimiento=null;
                @endphp
                <ul>
                    @foreach ($user->ucliente->cliente->postulantes as $postulante)
                        <li><b>Programa de Estudios:</b> {{ $postulante->carrera->nombreCarrera }} <b>Año/Periodo:</b> {{ $postulante->admisione->nombre }} <b>Ingreso:</b> @if(isset($postulante->estudiante->id)) SI <i class="far fa-smile-beam"></i> @else NO @endif</li>
                        @php
                            $nacimiento = $postulante->fechaNacimiento;
                        @endphp
                    @endforeach
                </ul>
                {!! Form::label('nacimiento', 'Fecha Nacimiento', [null]) !!}
                {!! Form::date('nacimiento', $nacimiento, ['class'=>'form-control']) !!}
                <!--   -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@stop