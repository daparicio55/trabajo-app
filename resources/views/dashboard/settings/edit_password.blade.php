@extends('adminlte::page')

@section('title', 'Edit Password')

@section('content')
{!! Form::open(['route'=>'dashboard.update_password','method'=>'put']) !!}
    <div class="container">
        <div class="card mt-3">
            <div class="card-header bg-info">
                <div class="card-title">
                    <h4>Editar Contraseña</h4>
                </div>
            </div>
            <div class="card-body">
                {!! Form::label('old', 'Password Anterior', ['class'=>'d-block']) !!}
                <input type="password" name="old" id="old" class="form-control" value="{{ old('old') }}">
                @error('old')
                    <small class="text-white bg-danger pl-3 pr-3 pt-1 pb-1 mt-3 rounded">{{ $message }}</small>    
                @enderror
                {!! Form::label('password1', 'Contraseña', ['class'=>'d-block']) !!}
                <input type="password" name="password1" id="password1" class="form-control" value="{{ old('password1') }}">
                @error('password1')
                    <small class="text-white bg-danger pl-3 pr-3 pt-1 pb-1 mt-3 rounded">{{ $message }}</small>
                @enderror
                {!! Form::label('password2', 'Confirmar Contraseña', ['class'=>'d-block']) !!}
                <input type="password" name="password2" id="password2" class="form-control" value="{{ old('password2') }}">
                @error('password2')
                    <small class="text-white bg-danger pl-3 pr-3 pt-1 pb-1 mt-3 rounded">{{ $message }}</small>
                @enderror
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