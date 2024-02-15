@extends('adminlte::page')

@section('title', 'Reportes Control')

@section('content_header')
    <h1 class="text-danger"><i class="far fa-chart-bar"></i> Reportes del Sistema</h1>
@stop

@section('content')
    <p>Seleccione los criterios para hacer una busqueda.</p>
    <div class="card">
        <div class="card-header bg-info">
            <p class="card-title">Reporte de Ofertas Laborales
                @isset($_GET['ffin_empleo'])
                @php
                    $ruta = $_GET['criterio_empleo'] . ':' . $_GET['finicio_empleo'] .':'. $_GET['ffin_empleo'];    
                @endphp
                <a href="{{ route('dashboard.administrador.reportes.reporte_empleo.excel',$ruta) }}" class="btn btn-success" title="descargar Excel">
                    <i class="far fa-file-excel"></i>
                </a>
                @endisset  
            </p>
        </div>
        <div class="card-footer">
            {!! Form::open(['route'=>'dashboard.administrador.reportes.reporte_empleo','method'=>'get','id'=>'frm']) !!}
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('criterio_empleo', 'Criterio de busqueda', [null]) !!}
                    <input type="text" name="criterio_empleo" class="form-control" @isset($_GET['criterio_empleo']) value="{{ $_GET['criterio_empleo'] }}" @endisset>
                </div>
                <div class="col-sm-12 col-md-3">
                    {!! Form::label('finicio_empleo', 'Fecha Inicio(*)', [null]) !!}
                    <input type="date" name="finicio_empleo" id="finicio_empleo" class="form-control" @isset($_GET['finicio_empleo']) value="{{ $_GET['finicio_empleo'] }}" @endisset>
                    @error('finicio_empleo')    
                        <div class="alert alert-danger mt-2" role="alert">
                            <small>
                                {{ $message }}
                            </small>
                        </div>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-3">
                    {!! Form::label('ffin_empleo', 'Fecha Fin(*)', [null]) !!}
                    <input type="date" name="ffin_empleo" id="ffin_empleo" class="form-control" @isset($_GET['ffin_empleo']) value="{{ $_GET['ffin_empleo'] }}" @endisset>
                    @error('ffin_empleo')    
                        <div class="alert alert-danger mt-2" role="alert">
                            <small>
                                {{ $message }}
                            </small>
                        </div>
                    @enderror
                </div>
                <p>(*) los campos son obligarios</p>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <button type="submit" id="btn-empleo-search" class="btn btn-info" title="buscar ofertas laborales">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>Oferta Laboral</th>
                            <th>Ubicación</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($empleos)
                            @foreach ($empleos as $key => $empleo)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $empleo->empresa->razonSocial }}</td>
                                    <td>{{ $empleo->titulo }}</td>
                                    <td>{{ $empleo->ubicacione->nombre }}</td>
                                    <td>{{ date('d-m-Y',strtotime($empleo->fecha_registro)) }}</td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop