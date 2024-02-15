@extends('adminlte::page')

@section('title', 'Lista de Empresas')

@section('content_header')
    <h1>Empresas Registradas</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a class="btn btn-outline-success" href="{{ route('dashboard.administrador.empresas.create') }}">
                <i class="fas fa-marker"></i> Registrar Empresa.
            </a>
        </form>
      </nav>
@stop

@section('content')
    <p>Lista de empresas registradas en el sistema.</p>
    <div class="card">
        <div class="card-body">
            <table class="table" id="estudiantes">
                <thead>
                    <tr>
                        <th>RUC</th>
                        <th>Razón Social</th>
                        <th>Dirección</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td>{{ $empresa->ruc }}</td>
                            <td>{{ Str::upper($empresa->razonSocial) }}</td>
                            <td>{{ $empresa->direccion }}</td>                            
                            <td>
                                <a href="{{ route('dashboard.administrador.empresas.show',$empresa->idEmpresa) }}" title="mostrar detalles" class="mt-2 btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('dashboard.administrador.empresas.edit',$empresa->idEmpresa) }}" title="editar empresa" class="mt-2 btn btn-success">
                                    <i class="far fa-edit"></i>
                                </a>
                                @if(isset($empresa->usuario[0]->id))
                                    <a data-toggle="modal" data-target="#modal-{{ $empresa->idEmpresa }}-email" class="mt-2 btn btn-warning" title="enviar correo de recuperacion">
                                        <i class="fas fa-envelope"></i>                              
                                    </a>
                                @else
                                    <a data-toggle="modal" data-target="#modal-{{ $empresa->idEmpresa }}-make" class="mt-2 btn btn-primary" title="crear usuario del sistema">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                @endif
                                <a data-toggle="modal" data-target="#modal-{{ $empresa->idEmpresa }}-delete" title="eliminar empresa" class="mt-2 btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @include('dashboard.administrador.empresas.modal')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop

@section('css')
    
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
    @if(session('info')!== null)
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
    @if(session('error') !== null)
    @php
        $message = session('error');
    @endphp
    <script> 
        
            toastr.options  = {
            "progressBar" : true,
        }
        toastr.error("{{ $message }}");
    </script>
    @endif
@stop