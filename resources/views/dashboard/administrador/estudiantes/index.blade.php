@extends('adminlte::page')

@section('title', 'Reg. en Espera')

@section('content_header')
    <h1>Alumnos y Egresados Registrados</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a href="{{ route('dashboard.administrador.alumnos.create') }}" class="btn btn-outline-success">
                <i class="fas fa-marker"></i> Nuevo Registro
            </a>
          {{-- <button class="btn btn-sm btn-outline-secondary" type="button">Smaller button</button> --}}
        </form>
      </nav>
@stop

@section('content')
    <p>Lista de alumnos registrados en el sistema.</p>
    <div class="card">
        <div class="card-body">
            <table class="table" id="estudiantes">
                <thead>
                    <tr>
                        <th>APELLIDOS, Nombres</th>
                        <th>Programa de Estudios</th>
                        <th>A. Ingreso</th>
                        <th>Egresado</th>
                        <th></th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($estudiantes as $estudiante)
                        <tr>
                            <td>{{ Str::upper($estudiante->postulante->cliente->apellido) }}, {{ Str::title($estudiante->postulante->cliente->nombre) }}</td>
                            <td>{{ $estudiante->postulante->carrera->nombreCarrera }}</td>
                            <td>{{ $estudiante->postulante->admisione->periodo }}</td>
                            <td>
                                @if(egresado($estudiante->id))
                                    SI
                                @else
                                    NO
                                @endif
                            </td>
                            <td>
                                @if(isset($estudiante->postulante->cliente->ucliente->user_id))
                                    <a data-toggle="modal" data-target="#modal-{{ $estudiante->id }}-email" class="btn btn-warning" title="enviar correo de restablecimiento">
                                        <i class="fas fa-mail-bulk"></i>
                                    </a>
                                @else
                                    <a data-toggle="modal" data-target="#modal-{{ $estudiante->id }}-create" href="" class="btn btn-info" >
                                        <i class="fas fa-id-card" title="crear cuenta"></i>
                                    </a>
                                @endif
                                @include('dashboard.administrador.estudiantes.modal')
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>
    
@stop

@section('css')
    
@stop

@if (session('info'))
    @php
        $message = session('info');
    @endphp
    <script> 
        toastr.options  = {
            "progressBar" : true,
            }
            toastr.success('{{ $message }}');
    </script>
@endif
@if (session('error'))
    @php
        $message = session('error');
    @endphp
    <script> 
        toastr.options  = {
            "progressBar" : true,
            }
            toastr.danger('{{ $message }}');
    </script>
@endif



@section('js')
    <script> 
        $('#estudiantes').DataTable({
            responsive: true,
            autoWidth: false,
            order: false,
            language: {
                "decimal":        ".",
                "emptyTable":     "No hay datos disponibles en la tabla",
                "info":           "Mostrando _START_ hasta _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 hasta 0 de 0 registros",
                "infoFiltered":   "(filtrado de _MAX_ registros totales )",
                "lengthMenu":     "Mostrar _MENU_ registros por página",
                "loadingRecords": "Cargando ...",
                "search":         "Buscar:",
                "zeroRecords":    "No se encontraron registros coincidentes",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activar para ordenar columna ascendente",
                    "sortDescending": ": activar para ordenar columna descendente"
                }
            },
            ajax: 'http://localhost:8000/dashboard/administrador/alumnos/ajax/',
            columns:[
            {data:0},
            {data:1},
            {data:2},
            {data:3},
            {defaultContent: "<button>Editar</button>"}
            ],
        });
        
    </script>
    
@stop