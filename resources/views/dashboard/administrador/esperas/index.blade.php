@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Registros en Espera</h1>
@stop
@section('content')
    
    <p>Lista de nuevas solicitudes en espera.</p>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>APELLIDOS, Nombres</th>
                        <th>Programa de Estudios</th>
                        <th>Promocion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($esperas as $espera)
                        <tr>
                            <td>{{ $espera->dniRuc }}</td>
                            <td>{{ Str::upper($espera->apellido) }}, {{ Str::title($espera->nombre) }}</td>
                            <td>{{ $espera->carrera->nombreCarrera }}</td>
                            <td>{{ $espera->admisione->nombre }}</td>
                            <td>
                                
                                <a class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $espera->id }}" title="observar datos">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-warning" data-toggle="modal" data-target="#modal-{{ $espera->id }}-aceptar" title="aceptar solicitud">
                                    <i class="far fa-check-circle"></i>
                                </a>
                                <a class="btn btn-danger" data-toggle="modal" data-target="#modal-{{ $espera->id }}-eliminar" title="eliminar solicitud">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                @include('dashboard.administrador.esperas.modal')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


@if (session('info'))
    @php
        $message = session('info');
    @endphp
    @section('js')
        <script> 
            toastr.options  = {
                "progressBar" : true,
                }
                toastr.success('{{ $message }}');
        </script>
    @stop
@endif
@if (session('error'))
    @php
        $message = session('error');
    @endphp
    @section('js')
        <script> 
            toastr.options  = {
                "progressBar" : true,
                }
                toastr.danger('{{ $message }}');
        </script>
    @stop
@endif