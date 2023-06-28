@extends('layouts.portal.base')
@section('contenido')
    @include('layouts.portal.preheader')
    @include('layouts.portal.header')
    {!! Form::open(['route'=>'bussines_store','method'=>'post']) !!}
    <div class="main-banner wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-lg-12 align-self-center">
                  <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                    <div class="fill-form">
                        <div class="row">
                        <div class="col-lg-12">
                            <h6>formulario de registro</h6>
                            <h2>DATOS DE LA EMPRESA</h2>
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <fieldset>
                                        <input type="text" name="ruc" id="ruc" placeholder="RUC" autocomplete="on" value="{{ old('ruc') }}">
                                        @error('ruc')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Email" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" name="contacto" id="contacto" placeholder="Contacto" autocomplete="on" value="{{ old('contacto') }}">
                                        @error('contacto')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" name="telefono1" id="telefono1" placeholder="Telefono" autocomplete="on" value="{{ old('telefono1') }}">
                                        @error('telefono1')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" name="telefono2" id="telefono2" placeholder="Telefono secundario" autocomplete="on" value="{{ old('telefono2') }}">
                                        @error('telefono2')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <select name="sector">
                                            <option value="0" >Sector</option>
                                            @foreach ($sectores as $sector)
                                                <option value="{{ $sector->id }}">{{ $sector->nombre}}</option>
                                            @endforeach
                                        </select>
                                        @error('sector')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <select name="rubro">
                                            <option value="0" >Rubro</option>
                                            @foreach ($rubros as $rubro)
                                                <option value="{{ $rubro->id }}">{{ $rubro->nombre}}</option>
                                            @endforeach
                                        </select>
                                        @error('rubro')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="border-first-button scroll-to-section mt-3">
                                <button type="submit">
                                    Crear Cuenta
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p>si ya tienes cuenta inicia sesion <a href="{{ route('dashboard.index') }}">aca</a></p>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    {!! Form::close() !!}
    @include('layouts.portal.footer')
@stop