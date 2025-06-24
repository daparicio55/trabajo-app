@extends('layouts.portal.base')
@section('titulo', 'Mostrando Oferta Laboral')
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
                        <div class="col-lg-12 align-self-center  wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                    @php
                                        $fecha = Carbon\Carbon::parse($empleo->fecha_registro)->locale('es');
                                    @endphp
                                    <h4>{{ $empleo->titulo }}</h4>
                                    <h6>{{ $empleo->empresa->razonSocial }}</h6>
                                    <em><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        {{ $empleo->ubicacione->nombre }} - {{ $empleo->ubicacione->padre->nombre }}</em>
                                    <div class="line-dec"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-9 align-self-center  wow fadeInRight" data-wow-duration="1s"
                                data-wow-delay="0.5s">
                                    {!! $empleo->descripcion !!}
                            </div>
                            <div class="col-sm-12 col-md-3 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        Experiencia: @if ($empleo->experiencia == 0)
                                            NO
                                        @else
                                            SI
                                        @endif
                                    </div>
                                    <div class="card-header bg-danger text-white mt-2">
                                        Turno: {{ $empleo->turno->nombre }}
                                    </div>
                                    <div class="card-header bg-dark text-white mt-2">
                                        {{-- Cierre: {{ date('d M Y', strtotime($empleo->fecha_postulacion)) }} --}}
                                        Cierre: {{ date('d', strtotime($empleo->fecha_postulacion)) }} {{ __(date('F', strtotime($empleo->fecha_postulacion))) }} {{ date('Y', strtotime($empleo->fecha_postulacion)) }}
                                    </div>
                                    <div class="card-body mt-3 text-center">
                                        @if (auth()->id() !== null)
                                            @if (count($empleo->postulaciones()->where('user_id', auth()->id())->get()) > 0)
                                                <a class="btn btn-danger disabled"><i class="fa fa-share-square-o"
                                                        aria-hidden="true"></i> Postulado</a>
                                            @else
                                                @php
                                                    $fecha = \Carbon\Carbon::parse(date('Y-m-d',strtotime(\Carbon\Carbon::now())));
                                                    $fempleo = \Carbon\Carbon::parse($empleo->fecha_postulacion);
                                                @endphp
                                                @if($fecha->gt($fempleo))
                                                    <a href="" class="btn btn-danger">
                                                       Postulacion Cerrada 
                                                    </a>        
                                                @else
                                                    <a href="{{ route('empleo_postular', $empleo->id) }}" id="btn_postularme"
                                                        class="btn btn-success"><i class="fa fa-share-square-o"
                                                    aria-hidden="true"></i> Postularme</a>
                                                @endif                                                
                                            @endif
                                        @else
                                            <a href="{{ route('empleo_postular', $empleo->id) }}" id="btn_postularme"
                                                class="btn btn-success"><i class="fa fa-share-square-o"
                                                    aria-hidden="true"></i> Postularme</a>
                                        @endif
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="javascript:history.back()" class="btn btn-secondary">Regresar</a>
                                    </div>
                                </div>
                            </div>
                            @if (auth()->id() !== null)
                              @if (count($empleo->postulaciones()->where('user_id', auth()->id())->get()) > 0)               
                                <div class="col-sm-12 col-md-9 wow fadeInRight">
                                  <div class="card">
                                    <div class="card-header bg-danger text-white h5">
                                      <i class="fa fa-briefcase" aria-hidden="true"></i> Datos de la EMPRESA
                                    </div>
                                    <div class="card-body">
                                      <ul>
                                        <li>Dirección: {{ $empleo->empresa->direccion }}</li>
                                        <li>Contacto: {{ $empleo->empresa->contacto1 }} @isset($empleo->empresa->contacto2) {{ $empleo->empresa->contacto2 }} @endisset</li>
                                        <li>Telefono: {{ $empleo->empresa->telefono1 }} @isset($empleo->empresa->telefono2) - {{ $empleo->empresa->telefono2 }} @endisset</li>
                                        <li>Email: {{ $empleo->empresa->email }}</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.portal.footer')
@stop
@section('js')
    <script>
        document.getElementById('btn_postularme').addEventListener('click', function() {
            this.classList.add('disabled');
        });
    </script>
@stop
