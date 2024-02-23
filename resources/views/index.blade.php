@extends('layouts.portal.base')
@section('titulo')
Bolsa Laboral - IEST Público Perú Japón
@endsection
@section('contenido')
    @include('layouts.portal.preheader')
    @include('layouts.portal.header')
    @include('layouts.portal.baner')
    @if (auth()->id() !== null)
        @include('layouts.portal.search')
        @include('layouts.portal.post')
    @endif
    @include('layouts.portal.footer')
@stop
@section('js')
    @if(session('info'))
    @php
        $message1 = session('info');
    @endphp
    <script> 
        toastr.options  = {
            "progressBar" : true,
            "timeOut": 7000,
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