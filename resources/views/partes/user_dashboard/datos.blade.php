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