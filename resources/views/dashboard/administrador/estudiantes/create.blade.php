@extends('adminlte::page')

@section('title', 'Registrar Alumno o Egresado')

@section('content_header')
    <h1><i class="fas fa-graduation-cap"></i> Nuevo Registro</h1>
@stop
@section('content')
{!! Form::open(['route'=>'dashboard.administrador.alumnos.store','method'=>'post']) !!}
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" id="searchText" name="searchText" placeholder="Ingrese DNI a buscar ...">
        <span class="input-group-btn">
            <button type="button" id="btn_buscar" class="btn btn-primary">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
        </span>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fa fa-user" aria-hidden="true"></i> Datos Personales.</h4>
            </div>
            <div class="card-body">
                {!! Form::hidden('cliente', null, ['id'=>'cliente']) !!}
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="apellido">Apellidos</label>
                            {!! Form::text('apellido', null, ['class'=>'form-control','required','id'=>'apellido']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="nombre">Nombres</label>
                            {!! Form::text('nombre', null, ['class'=>'form-control','required','id'=>'nombre']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono">Tel. Llamadas</label>
                            {!! Form::text('telefono', null, ['class'=>'form-control','required','id'=>'telefono']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono2">Tel. WhatsApp</label>
                            {!! Form::text('telefono2', null, ['class'=>'form-control','required','id'=>'telefono2']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila --}}
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="email">E. Mail</label>
                            {!! Form::text('email', null, ['class'=>'form-control','required','id'=>'email']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila de direccion--}}
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="direccion">Dirección</label>
                            {!! Form::text('direccion', null, ['class'=>'form-control','required','id'=>'direccion']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            {!! Form::label('sexo', "Sexo", [null]) !!}
                            {!! Form::select('sexo', $sexos, null, ['class'=>'form-control','id'=>'sexo']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('fechaNacimiento', 'Nacimiento', [null]) !!}
                        {!! Form::date('fechaNacimiento', null, ['class'=>'form-control','id'=>'fechaNacimiento']) !!}
                    </div>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>
<!-- DATOS DE LA CARRERA -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-briefcase"></i> Datos de Carrera.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        {!! Form::label(null, 'Carrera', [null]) !!}
                        {!! Form::select('idCarrera', $carreras, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        {!! Form::label(null, 'Periodo', [null]) !!}
                        {!! Form::select('admisione_id', $admisiones, null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modalidad de postulaciones --}}
{{-- discapacidad --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-crutch" aria-hidden="true"></i> Discapacidad.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- siguiente linea --}}
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <label for="">¿Es usted una persona con discapacidad?</label>
                        <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value=0 name="discapacidad" required> SI
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value=1 name="discapacidad" required> NO
                            </label>
                          </div>
                          <label for="discapacidadNombre">¿Cual?</label>
                          {!! Form::text('discapacidadNombre', '-', ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info" id="btn_enviar">
                    <i class="far fa-save"></i> Guardar
                </button>
                <button type="button" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('js')
<script>
    let url = "{{ asset('') }}"
</script>
<script src="{{ asset('assets/js/admin.js') }}">
    
</script>
@stop