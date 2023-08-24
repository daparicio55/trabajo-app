@extends('layouts.portal.base')
@section('contenido')
    @include('layouts.portal.preheader')
    @include('layouts.portal.header')
    <div class="services section">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                {{-- <h6>Our Services</h6> --}}
                <h4>Panel <em> Control</em></h4>
                <div class="line-dec"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="naccs">
                <div class="grid">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="menu">
                        <div class="first-thumb active">
                          <div class="thumb">                 
                            <span class="icon"><img src="{{ asset('assets/images/demandante-de-empleo.png') }}" alt=""></span>
                            Ofertas
                          </div>
                        </div>
                        <div>
                          <div class="thumb">                 
                            <span class="icon"><img src="{{ asset('assets/images/headhunting.png') }}" alt=""></span>
                            Postulaciones
                          </div>
                        </div>
                        <div >
                          <div class="thumb">
                            <span class="icon"><img src="{{ asset('assets/images/panel-de-administrador.png') }}" alt=""></span>
                            Datos
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="col-lg-12">
                      <ul class="nacc">
                        <!-- ofertas segun programa de estudios -->
                        <li class="active">
                          <div>
                            <div class="thumb">
                              <div class="row">
                                <div class=" col-md-12 col-lg-12 align-self-center">
                                  <div class="left-text">
                                    <h4>Ofertas Laborales Sugeridas</h4>
                                    <p>revisa las nuevas ofertas laborales orientadas a tu programa de estudios. Las ofertas en rojo estan fuera de fecha de postulacion.</p>
                                    <div class="ticks-list">
                                      <div class="table-responsive">
                                        <table class="table" id="ofertas">
                                            <thead>
                                                <tr>
                                                    <th>Registro</th>
                                                    <th>Cierre</th>
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
                                                            <a href="{{ route('empleo',$empleo->id) }}" class="btn btn-info btn-lg" title="ver oferta laboral">
                                                                <i class="fa fa-eye text-white"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                    <p><span class="text-danger">(*)</span> las ofertas en rojo son con fechas caducadas o vencidas...</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div>
                            <div class="thumb">
                              <div class="row">
                                <div class="col-lg-12 align-self-center">
                                  <div class="left-text">
                                    <h4>Lista de Postulaciones </h4>
                                    <div class="ticks-list">
                                      <div class="table-responsive">
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
                                                            <a class="btn btn-info text-white m-1" href="{{ route('empleo',$postulacione->empleo->id) }}" title="detalles">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a data-toggle="modal" data-target="#modal-{{ $postulacione->id }}-eliminar" class="btn btn-danger m-1" title="eliminar mi postulacion">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                        @include('dashboard.user.modal')
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div>
                            <div class="thumb">
                              <div class="row d-flex justify-content-center">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="left-text">
                                        {!! Form::open(['route'=>['dashboard.settings.update',$user->id],'method'=>'put']) !!}
                                        <h4>Actualizar Datos Personales</h4>
                                        {!! Form::label('name', 'Nombres y Apellidos', [null]) !!}
                                        {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
                                        {!! Form::label('email', 'Correo', ['class'=>'mt-2']) !!}
                                        {!! Form::text('email', $user->email, ['class'=>'form-control']) !!}
                                        {!! Form::label('telefono1', 'Telefono 1', ['class'=>'mt-2']) !!}
                                        {!! Form::text('telefono1', $user->ucliente->cliente->telefono, ['class'=>'form-control']) !!}
                                        {!! Form::label('telefono2', 'Telefono 2', ['class'=>'mt-2']) !!}
                                        {!! Form::text('telefono2', $user->ucliente->cliente->telefono2, ['class'=>'form-control']) !!}
                                        {!! Form::label('direccion', 'Direccion', ['class'=>'mt-2']) !!}
                                        {!! Form::text('direccion', $user->ucliente->cliente->direccion, ['class'=>'form-control']) !!}
                                        @php
                                            $nacimiento=null;
                                        @endphp
                                        @foreach ($user->ucliente->cliente->postulantes as $postulante)                                                
                                            @php
                                                $nacimiento = $postulante->fechaNacimiento;
                                            @endphp
                                        @endforeach
                                        {!! Form::label('nacimiento', 'Fecha Nacimiento', ['class'=>'mt-2']) !!}
                                        {!! Form::date('nacimiento', $nacimiento, ['class'=>'form-control']) !!}
                                        <button type="submit" class="btn btn-primary text-white mt-3">
                                            <i class="fa fa-save"></i> Actualizar
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                  <div class="left-text">
                                    {!! Form::open(['route'=>'dashboard.update_password','method'=>'put']) !!}
                                        <h4>Actualizar Contraseña</h4>
                                        {!! Form::label('old', 'Password Anterior', ['class'=>'d-block']) !!}
                                        <input type="password" name="old" id="old" class="form-control mt-2 mb-2" value="{{ old('old') }}">
                                        @error('old')
                                            <small class="text-white bg-danger pl-3 pr-3 pt-1 pb-1 mt-3 rounded">{{ $message }}</small>    
                                        @enderror
                                        {!! Form::label('password1', 'Contraseña', ['class'=>'d-block mt-2']) !!}
                                        <input type="password" name="password1" id="password1" class="form-control mt-2 mb-2" value="{{ old('password1') }}">
                                        @error('password1')
                                            <small class="text-white bg-danger pl-3 pr-3 pt-1 pb-1 mt-3 rounded">{{ $message }}</small>
                                        @enderror
                                        {!! Form::label('password2', 'Confirmar Contraseña', ['class'=>'d-block mt-2']) !!}
                                        <input type="password" name="password2" id="password2" class="form-control mt-2 mb-2" value="{{ old('password2') }}">
                                        @error('password2')
                                            <small class="text-white bg-danger pl-3 pr-3 pt-1 pb-1 mt-3 rounded">{{ $message }}</small>
                                        @enderror
                                        <button type="submit" class="d-block btn btn-primary text-white mt-3">
                                            <i class="fa fa-save"></i> Actualizar
                                        </button>
                                    {!! Form::close() !!}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
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