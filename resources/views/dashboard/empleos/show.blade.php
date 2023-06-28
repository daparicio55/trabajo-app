@extends('adminlte::page')

@section('title', 'Postulaciones')

@section('content_header')

    <h1>Lista de Postulantes para el empleo</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table" id="estudiantes">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Telefonos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleo->postulaciones as $postulacione)
                    <tr>
                        <td>{{ $postulacione->user->ucliente->cliente->apellido }}, {{ $postulacione->user->ucliente->cliente->nombre }}</td>
                        <td>{{ $postulacione->user->email }}</td>
                        <td>{{ $postulacione->user->ucliente->cliente->telefono }} / {{ $postulacione->user->ucliente->cliente->telefono2 }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#modal-{{ $postulacione->id }}-show" title="Detalles" class="btn btn-info">
                                <i class="fas fa-binoculars"></i>
                            </a>
                            @include('dashboard.empleos.modal_show')
                        </td>
                        {{-- <td>
                            <a data-toggle="modal" data-target="#modal-{{ $empleo->id }}-show" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-success" href="{{ route('dashboard.empleos.edit',$empleo->id) }}">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a data-toggle="modal" data-target="#modal-{{ $empleo->id }}-delete" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            @include('dashboard.empleos.modal')
                        </td> --}}
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
            columnDefs: [{
                orderable: false,
                //width: '100px',
                targets: [3]
            }],
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