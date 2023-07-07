@extends('adminlte::page')

@section('title', 'Reg. en Espera')

@section('content_header')
    <h1>Empresas en espera</h1>
@stop

@section('content')
    <p>Lista de peticiones de empresas para registro en el sistema.</p>
    <div class="card">
        <div class="card-body">
            <table class="table" id="esperas">
                <thead>
                    <tr>
                        <th>RUC</th>
                        <th>Contacto</th>
                        <th>Telefono 1</th>
                        <th>Telefono 2</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($esperas as $espera)
                        <tr>
                            <td>{{ $espera->ruc }}</td>
                            <td>{{ $espera->contacto }}</td>
                            <td>{{ $espera->telefono1 }}</td>
                            <td>{{ $espera->telefono2 }}</td>
                            <td>
                                <a class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $espera->id }}-show" title="observar datos">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-warning" data-toggle="modal" data-target="#modal-{{ $espera->id }}-aceptar" title="aceptar solicitud">
                                    <i class="far fa-check-circle"></i>
                                </a>
                                <a class="btn btn-danger" data-toggle="modal" data-target="#modal-{{ $espera->id }}-eliminar" title="eliminar solicitud">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                @include('dashboard.administrador.empresas.modal_esperas')
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
        $('#esperas').DataTable({
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: '150px',
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
    <script>
        let btn_search = document.getElementById("btn_search");
        btn_search.addEventListener("click",function(){
            btn_search.setAttribute('disabled',true);    
            let txt_ruc = document.getElementById("ruc");
            let ruc = txt_ruc.value;
            
            console.log(ruc);
            if(ruc.length == 11){
                let token = '{{ csrf_token() }}';
                console.log(token);
                let url = "{{ asset('/dashboard/administrador/empresas/getruc') }}";
                fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ruc: ruc, _token: token })
                })
                .then(response => response.json())
                .then(data => {
                    // Aquí puedes manejar la respuesta recibida desde Laravel
                    console.log(data);
                    var objeto = JSON.parse(data);
                    console.log(objeto);
                    let razon = objeto.razonSocial;
                    document.getElementById('razon').value = objeto.razonSocial;
                    document.getElementById('direccion').value = objeto.direccion;
                    document.getElementById('distrito').value = objeto.distrito;
                    document.getElementById('provincia').value = objeto.provincia;
                    document.getElementById('region').value = objeto.departamento;
                    btn_search.removeAttribute('disabled');
                })
                .catch(error => {
                    // Aquí puedes manejar cualquier error que ocurra durante la petición
                    console.log(error);
                });
            
                console.log(url);
            }else{
                alert('tiene que tener 11 numeros')
            }
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
                toastr.danger('{{ $message }}');
        </script>
    @endif
@stop