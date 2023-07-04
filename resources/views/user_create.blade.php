@extends('layouts.portal.base')
@section('contenido')
    @include('layouts.portal.preheader')
    @include('layouts.portal.header')
    {!! Form::open(['route'=>'user_store','method'=>'post']) !!}
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
                            <h2>DATOS PERSONALES</h2>
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <fieldset>
                                        <input type="text" name="dniRuc" id="dniRuc" placeholder="DNI" autocomplete="on" value="{{ old('dniRuc') }}">
                                        @error('dniRuc')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" name="nombre" id="name" placeholder="Nombres" autocomplete="on" value="{{ old('nombre') }}">
                                        @error('nombre')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" name="apellido" id="apellido" placeholder="Apellidos" autocomplete="on" value="{{ old('apellido') }}">
                                        @error('apellido')
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
                                        <input type="date" name="fnacimiento" placeholder="fecha de nacimiento" autocomplete="on" title="fecha de nacimiento" value="{{ old('fnacimiento') }}">
                                        @error('fnacimiento')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" name="telefono1" id="telefono1" placeholder="telefono #1" autocomplete="on" title="telefono principal" value="{{ old('telefono1') }}">
                                        @error('telefono1')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" name="telefono2" id="telefono2" placeholder="telefono #2" autocomplete="on" title="telefono alternativo" value="{{ old('telefono2') }}">
                                    </fieldset>
                                    <fieldset>
                                        <select name="sexo">
                                            <option value="Sexo" >Sexo</option>
                                            <option value="Masculino" @if(old('sexo')=="Masculino") selected @endif>Masculino</option>
                                            <option value="Femenino" @if(old('sexo')=="Femenino") selected @endif>Femenino</option>
                                        </select>
                                        @error('sexo')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <select name="ingreso" title="año de ingreso">
                                            <option value="0">Año de Ingreso</option>
                                            @foreach ($admisiones as $admisione)
                                                <option value="{{ $admisione->id }}" @if(old('ingreso')==$admisione->id) selected @endif>{{ $admisione->periodo }}</option>
                                            @endforeach
                                        </select>
                                        @error('ingreso')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                    <fieldset>
                                        <select name="carrera" title="programa de estudios">
                                            <option value="0">Programa de Estudios</option>
                                            @foreach ($programas as $programa)
                                                <option value="{{ $programa->idCarrera }}" @if(old('carrera')==$programa->idCarrera) selected @endif>{{ $programa->nombreCarrera }}</option>
                                            @endforeach
                                        </select>
                                        @error('carrera')
                                            <small class="text-white px-3 mx-3 bg-danger border rounded">{{ $message }}</small>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-3" style="line-height : 20px">"Regístrese para acceder a oportunidades laborales exclusivas.¡Obtenga ventaja en su búsqueda de empleo al registrarse hoy!"</p> --}}
                        </div>
                        <div class="col-lg-12">
                            <div class="border-first-button scroll-to-section mt-3">
                                <button type="submit">
                                    Crear Cuenta
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p>si ya tienes cuenta inicia sesion <a href="{{ route('dashboard.index') }}">Aquí</a></p>
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