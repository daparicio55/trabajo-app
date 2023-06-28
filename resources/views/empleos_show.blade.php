@extends('layouts.portal.base')
@section('titulo','Mostrando Oferta Laboral')
@section('css')
    <style>
        .job-card {
        background-color: #fff;
        border: 1px solid #ddd;
        margin-bottom: 20px;
        }
        .job-card .card-body {
        padding: 20px;
        }
        .job-card .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        }
        .job-card .card-text {
        margin-bottom: 10px;
        }
        .job-card .location {
        color: #007bff;
        margin-bottom: 10px;
        }
        .job-card .fa-map-marker-alt {
        margin-right: 5px;
        }
        .job-card .fa-clock {
        margin-right: 5px;
        }
        .job-card .date {
        color: #6c757d;
        margin-bottom: 10px;
        }
        .job-card .fa-calendar-alt {
        margin-right: 5px;
        }
  </style>
@stop
@section('contenido')
    @include('layouts.portal.preheader')
    @include('layouts.portal.header')
    <div class="container">
        <h1 class="text-center my-5">Resultados de Búsqueda de Empleos</h1>
        <div class="row">

            @foreach ($empleos as $empleo)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="card-title  text-white pt-2"><i class="fa fa-briefcase" aria-hidden="true"></i> {{ $empleo->titulo }}</h5>
                    </div>
                    <div class="card-body">
                      <p class="text-black">
                        <i class="fa fa-building-o" aria-hidden="true"></i> Empresa: {{ $empleo->empresa->razonSocial }}
                      </p>
                      <p>
                        <span class="bg-danger text-white ps-3 pe-3 rounded">
                            <i class="fa fa-times" aria-hidden="true"></i> Cierre: {{ date('d M Y',strtotime($empleo->fecha_postulacion)) }}
                        </span>
                    </p>
                      <p style="text-align: right">
                        <a href="{{ route('empleo',$empleo->id) }}" class="btn btn-info btn-sm text-white"> <i class="fa fa-search-plus" aria-hidden="true"></i> detalles</a>
                      </p>
                    </div>
                    <div class="card-footer bg-secondary">
                      <small class="text-white">
                        <i class="fa fa-calendar" aria-hidden="true"></i> Registro: {{ date('d-m-Y',strtotime($empleo->fecha_registro)) }}
                      </small>
                    </div>
                  </div>
              </div>
            @endforeach
        </div>
      </div>
   


    @include('layouts.portal.footer')
@stop