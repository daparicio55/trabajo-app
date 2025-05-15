@extends('adminlte::page')

@section('title', 'Reg. en Espera')

@section('content_header')
    <h1>Estudiantes y Egresados Registrados</h1>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a href="{{ route('dashboard.administrador.alumnos.create') }}" class="btn btn-outline-success">
                <i class="fas fa-marker"></i> Nuevo Registro
            </a>
          {{-- <button class="btn btn-sm btn-outline-secondary" type="button">Smaller button</button> --}}
        </form>
      </nav>
      <p class="mt-2">(*)Los usuarios alumnos son responsabilidad de un Super Administrador, en esta sección solo le puede enviar correos de recuperación de contraseñas</p>
@stop

@section('content')
@include('dashboard.administrador.estudiantes.modal')
    <div class="card">
        <div class="card-body">
            <table class="table" id="estudiantes">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>APELLIDOS, Nombres</th>
                        <th>Programa de Estudios</th>
                        <th>A. Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
@stop


@section('js')


    @if (session('info'))
        @php
            $message = session('info');
        @endphp
    <script> 
        toastr.options  = {
            "progressBar" : true,
            "timeOut": "7000", // en milisegundos
            "extendedTimeOut": "2000",
            "positionClass": "toast-top-right"
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
                "timeOut": "7000", // en milisegundos
                "extendedTimeOut": "2000",
                "positionClass": "toast-top-right"
            }
            toastr.danger('{{ $message }}');
        </script>
    @endif

    <script> 
        $('#estudiantes').DataTable({
            responsive: true,
            autoWidth: false,
            order: false,
            processing: true,
            ajax: {
                url: "{{ route('dashboard.administrador.getEstudiantes') }}",
            },
            columns: [
                { data: 'dni', orderable: false },
                { data: 'cliente', orderable: false },
                { data: 'carrera', orderable: false },
                { data: 'admisione', orderable: false },
                { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
            ],
            language: {
                url: "{{ asset('assets/json/es-ES.json') }}"
            },
        });
        
        // Manejar el botón de eliminar
        $('#estudiantes').on('click', '.btn-email', function () {        
            const id = $(this).data('id');
            const email = $(this).data('email');
            $('#email_actualizar').val(email);
            $('#estudiante_id_email').val(id);            
        });

        $('#estudiantes').on('click', '.btn-crear', function () {        
            const id = $(this).data('id');
            const email = $(this).data('email');
            $('#email_crear').val(email);
            $('#estudiante_id_crear').val(id);
        });

        //desactivar el boton enviar cuando se manda el formulario
        $('#form-email').on('submit', function () {
            const button = $(this).find('button[type="submit"]');
            button.prop('disabled', true);
            button.html('<i class="fas fa-spinner fa-spin"></i> Enviando...');
        });

        $('#form-crear').on('submit', function () {
            const button = $(this).find('button[type="submit"]');
            button.prop('disabled', true);
            button.html('<i class="fas fa-spinner fa-spin"></i> Enviando...');
        });

    </script>
    
@stop