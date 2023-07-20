@extends('adminlte::page')

@section('title', 'Lista de Docentes')

@section('content_header')
    <h1>Docentes Registrados</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-outline-success" href="{{ route('dashboard.administrador.docentes.create') }}">
                <i class="fas fa-marker"></i> Registrar Docente.
            </a>
        </form>
      </nav>
@stop

@section('content')
    <p>Lista de empresas registradas en el sistema.</p>
    <div class="card">
        <div class="card-body">
            <table class="table" id="docentes">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr>
                            <td>{{ $docente->name }}</td>
                            <td>{{ $docente->email }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#modal-{{ $docente->id }}-show" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a data-toggle="modal" data-target="#modal-{{ $docente->id }}-edit" class="btn btn-success">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a data-toggle="modal" data-target="#modal-{{ $docente->id }}-delete" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
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
        $('#docentes').DataTable({
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
        toastr.danger("{!! $message !!}");
    </script>
    @endif
@stop