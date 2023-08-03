@extends('adminlte::page')

@section('title', 'Ofertas laborales sugeridas')

@section('content_header')
    <h1>Ofertas Laborales Sugeridas</h1>
@stop

@section('content')
    <p>revisa las nuevas ofertas laborales orientadas a tu programa de estudios. Las ofertas en <span class="text-danger">rojo</span> estan fuera de fecha de postulacion.</p>
    <div class="card">
        <div class="card-body">
            <table class="table" id="estudiantes">
                <thead>
                    <tr>
                        <th>F. Registro</th>
                        <th>F. Cierre</th>
                        <th>Empresa</th>
                        <th>Titulo</th>
                        <th>Ubicacion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($empleos as $empleo)
                        @php
                            $fecha = Carbon\Carbon::parse($empleo->fecha_postulacion);
                        @endphp
                        <tr @if($fecha->isPast()) class="text-danger" @endif>
                            <td>{{ date('d-m-Y',strtotime($empleo->fecha_registro)) }}</td>
                            <td @if($fecha->isPast()) class="font-weight-bold" @endif>{{ date('d-m-Y',strtotime($empleo->fecha_postulacion)) }}</td>
                            <td>{{ $empleo->empresa->razonSocial }}</td>
                            <td>{{ $empleo->titulo }}</td>
                            <td>{{ $empleo->ubicacione->nombre }}</td>
                            <td>
                                <a href="{{ route('empleo',$empleo->id) }}" class="btn btn-info" title="ver oferta laboral">
                                    <i class="far fa-eye"></i>
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
        $('#estudiantes').DataTable({
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: '100px',
                targets: [4]
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