@extends('layouts.portal.base')
@section('titulo','Mostrando Oferta Laboral')
@section('contenido')
    @include('layouts.portal.preheader')
    @include('layouts.portal.header')
      
    <div id="about" class="about section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                  <img src="assets/images/about-dec-v3.png" alt="">
                </div>
              </div>
              <div class="col-lg-12 align-self-center  wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="about-right-content">
                  <div class="section-heading">
                    @php
                      $fecha = Carbon\Carbon::parse($empleo->fecha_registro)->locale('es');
                    @endphp
                    {{-- <h6>{{ $fecha->formatLocalized('%A %d %B %Y') }}</h6> --}}
                    <h6>{{ $empleo->titulo }}</h6>
                    <h4>{{ $empleo->empresa->razonSocial }}</h4>
                    <em><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $empleo->ubicacione->nombre}} - {{ $empleo->ubicacione->padre->nombre }}</em>
                    <div class="line-dec"></div>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-9 align-self-center  wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                  {!! $empleo->descripcion !!}
                </div>
                <div class="col-sm-3 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                  <div class="card">
                    <div class="card-header bg-info text-white">
                      Experiencia: @if($empleo->experiencia == 0) NO @else SI @endif
                    </div>
                    <div class="card-header bg-danger text-white mt-2">
                      Turno: {{ $empleo->turno->nombre }}
                    </div>
                    <div class="card-header bg-dark text-white mt-2">
                      Cierre: {{date('d M Y',strtotime($empleo->fecha_postulacion)) }}
                    </div>
                    <div class="card-body mt-3 text-center">
                      <a href="{{ route('empleo_postular',$empleo->id) }}" class="btn btn-success"> <i class="fa fa-share-square-o" aria-hidden="true"></i> Postularme</a>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.portal.footer')
@stop