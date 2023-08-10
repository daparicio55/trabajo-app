@extends('adminlte::page')

@section('title', 'Reg. de Postulaciones')

@section('content_header')
    <h1>Postulaciones Realizadas</h1>
@stop

@section('content')
    <p>Lista postulaciones a empleos en la plataforma.</p>
    <div class="card">
        <div class="card-body">
            <table class="table" id="postulaciones">
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
                    @foreach ($postulaciones as $postulacione)
                        <tr>
                            <td>{{ date('d-m-Y',strtotime($postulacione->fecha)) }}</td>
                            <td>{{ $postulacione->empleo->empresa->razonSocial }}</td>
                            <td>{{ $postulacione->empleo->titulo }}</td>
                            <td>{{ $postulacione->empleo->ubicacione->nombre }}</td>
                            <td>
                                <a data-toggle="modal" class="btn btn-info" data-target="#modal-{{ $postulacione->id }}-detalles" title="detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a data-toggle="modal" data-target="#modal-{{ $postulacione->id }}-eliminar" class="btn btn-danger" title="eliminar mi postulacion">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            @include('dashboard.user.modal')
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop
@section('js')
    <script> 
        $('#postulaciones').DataTable({
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