@extends('adminlte::page')

@section('title', 'Reg. en Espera')

@section('content_header')
    <h1>Empleos Registrados</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-outline-success" href="{{ route('dashboard.empleos.create') }}">
                <i class="fas fa-marker"></i> Registrar Nuevo Empleo.
            </a>
        </form>
      </nav>
@stop

@section('content')
    <p>Lista de empleos registradas en el sistema.</p>
    <div class="card">
        <div class="card-body">
            <table class="table" id="estudiantes">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Empresa</th>
                        <th>Titulo</th>
                        <th>Ubicacion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleos as $empleo)
                        <tr>
                            <td>{{ $empleo->fecha_registro }}</td>
                            <td>{{ $empleo->empresa->razonSocial }}</td>
                            <td>{{ $empleo->titulo }}</td>
                            <td>{{ $empleo->ubicacione->nombre }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('dashboard.empleos.show',$empleo->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-success" href="{{ route('dashboard.empleos.edit',$empleo->id) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a data-toggle="modal" data-target="#modal-{{ $empleo->id }}-delete" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                @include('dashboard.empleos.modal')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop
@section('js')
    <script> 
        $('#estudiantes').DataTable({
            responsive: true,
            autoWidth: false,
            /* columnDefs: [{
                orderable: false,
                width: '100px',
                targets: [2]
            }], */
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
        });
        
    </script>
    @if (session('info'))
        @php
            $message1 = session('info');
        @endphp
        <script> 
            toastr.options  = {
                "progressBar" : true,
                }
                toastr.success('{{ $message1 }}');
        </script>
    @endif
    @if (session('error'))
        @php
            $message2 = session('error');
        @endphp
        <script> 
            toastr.options  = {
                "progressBar" : true,
                }
                toastr.error('{{ $message2 }}');
        </script>
    @endif
@stop