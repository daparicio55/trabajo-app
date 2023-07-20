@extends('adminlte::page')

@section('title', 'Registrar Empresa')

@section('content_header')
    <h1>Registrar Empresa</h1>
@stop
@section('content')
    {!! Form::open(['route'=>'dashboard.administrador.empresas.store','method'=>'post','id'=>'frm']) !!}
    <div class="card">
        <div class="card-header bg bg-info">
            <a href="{{ route('dashboard.administrador.empresas.index') }}" class="btn btn-danger">
                <i class="fas fa-backward" title="regresar"></i>
            </a> 
                <h4 class="d-inline p-2">Datos</h4>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-10">
                    {!! Form::label('ruc', "RUC", [null]) !!}
                    {!! Form::number('ruc', null, ['class'=>'form-control']) !!}
                    <button class="btn btn-info mt-1" id="btn_search">
                        <i class="fas fa-search"></i>
                    </button>
                    @error('ruc')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('razon', "Razon Social", ['class'=>'d-block']) !!}
                    {!! Form::text('razon', null, ['class'=>'form-control']) !!}
                    @error('razon')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('direccion', "Dirección", [null]) !!}
                    {!! Form::text('direccion', null, ['class'=>'form-control']) !!}
                    @error('direccion')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('distrito', "Distrito", [null]) !!}
                    {!! Form::text('distrito', null, ['class'=>'form-control']) !!}
                    @error('distrito')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('provincia', "Provincia", [null]) !!}
                    {!! Form::text('provincia', null, ['class'=>'form-control']) !!}
                    @error('provincia')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('region', "Region", [null]) !!}
                    {!! Form::text('region', null, ['class'=>'form-control']) !!}
                    @error('region')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('email', "Email", [null]) !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                    @error('email')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('telefono1', "Telefono 1", [null]) !!}
                    {!! Form::text('telefono1', null, ['class'=>'form-control']) !!}
                    @error('telefono1')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('telefono2', "Telefono 2", [null]) !!}
                    {!! Form::text('telefono2', null, ['class'=>'form-control']) !!}
                    {!! Form::label('contacto1', "Contacto 1", [null]) !!}
                    {!! Form::text('contacto1', null, ['class'=>'form-control']) !!}
                    @error('contacto1')
                        <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {!! Form::label('contacto2', "Contacto 2", [null]) !!}
                    {!! Form::text('contacto2', null, ['class'=>'form-control']) !!}
                    <!--- sectores -->
                    {!! Form::label('sectores', "Sector", ['class'=>'mt-3']) !!}
                    <a class="btn btn-info" id="btn_sectore">+</a>
                    <div class="row mt-2" style="display: none" id="card_sectore">
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <input type="text" id="txt_sectore" class="form-control">
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-primary" id="send_sectore">
                                        <i class="far fa-save"></i> Guardar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <select name="sector" id="sector" class="form-control mt-2">
                        <option value="0" >Seleccione</option>
                        @foreach ($sectores as $sectore)
                            <option value="{{ $sectore->id }}">{{ $sectore->nombre }}</option>            
                        @endforeach
                    </select>
                    @error('sector')
                        <small class="text-danger d-block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    {{-- rubros y sector --}}
                    {!! Form::label('rubro', "Rubro", ['class'=>'mt-3']) !!}
                    <a class="btn btn-info" id="btn_rubro">+</a>
                    <div class="row mt-2" style="display: none" id="card_rubro">
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <input type="text" id="txt_rubro" class="form-control">
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-primary" id="send_rubro">
                                        <i class="far fa-save"></i> Guardar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <select name="rubro" id="rubro" class="form-control mt-2">
                        <option value="0" >Seleccione</option>
                        @foreach ($rubros as $rubro)
                            <option value="{{ $rubro->id }}">{{ $rubro->nombre }}</option>            
                        @endforeach
                    </select>
                    
                    @error('rubro')
                        <small class="text-danger d-block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                    @enderror
                    
                </div>
            </div>
            
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">
                <i class="far fa-save"></i> Guardar
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    <script>
        let btn_search = document.getElementById("btn_search");
        btn_search.addEventListener("click",function(){
            btn_search.setAttribute('disabled',true);    
            let txt_ruc = document.getElementById("ruc");
            let ruc = txt_ruc.value;
            if(ruc.length == 11){
                let token = '{{ csrf_token() }}';
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
                    var objeto = JSON.parse(data);
                    let razon = objeto.razonSocial;
                    console.log(objeto);
                    document.getElementById('razon').value = objeto.razonSocial;
                    document.getElementById('direccion').value = objeto.direccion;
                    document.getElementById('distrito').value = objeto.distrito;
                    document.getElementById('provincia').value = objeto.provincia;
                    document.getElementById('region').value = objeto.departamento;
                    btn_search.removeAttribute('disabled');
                })
                .catch(error => {
                    // Aquí puedes manejar cualquier error que ocurra durante la petición
                    console.error(error);
                });
            
                console.log(url);
            }else{
                alert('tiene que tener 11 numeros')
            }
        });
        //mostramos y ocultamos el card para agregar rubro;
        let btn_rubro = document.getElementById("btn_rubro");
        btn_rubro.addEventListener("click", function(){
            let card = document.getElementById("card_rubro");
            if (card.style.display === 'none'){
                card.style.display = 'block';
            }else{
                card.style.display = 'none';
            }
        });
        //guardamos el rubro
        let send_rubro = document.getElementById("send_rubro");
        send_rubro.addEventListener("click",function(){
            let txt_rubro = document.getElementById("txt_rubro");
            if (txt_rubro.value.length === 0 ){
                console.log('vacio');
            }else{
                console.log('lleno');
                //enviamos el store
                let token = '{{ csrf_token() }}';
                let nombre = txt_rubro.value;
                let url = "{{ asset('/dashboard/administrador/rubros') }}";
                
                fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ nombre: nombre, _token: token })
                })
                .then(response => response.json())
                .then(data => {
                    // Aquí puedes manejar la respuesta recibida desde Laravel
                    //var objeto = JSON.parse(data);
                    console.log(data.id);
                    let selectrubro = document.getElementById('rubro');
                    let row = document.createElement("option");
                    row.value = data.id;
                    row.innerHTML= data.nombre;
                    console.log(row);
                    selectrubro.appendChild(row);
                    //ocultar el 
                    let card = document.getElementById("card_rubro");
                    card.style.display = "none";
                })
                .catch(error => {
                    // Aquí puedes manejar cualquier error que ocurra durante la petición
                    console.log(error);
                    //console.error(error);
                });
            }
        });





        //mostramos y ocultamos el card para agregar rubro;
        let btn_sectore = document.getElementById("btn_sectore");
        btn_sectore.addEventListener("click", function(){
            let card = document.getElementById("card_sectore");
            if (card.style.display === 'none'){
                card.style.display = 'block';
            }else{
                card.style.display = 'none';
            }
        });
        

        //guardamos el sector
        let send_sectore = document.getElementById("send_sectore");
        send_sectore.addEventListener("click",function(){
            let txt_sectore = document.getElementById("txt_sectore");
            if (txt_sectore.value.length === 0 ){
                console.log('vacio');
            }else{
                console.log('lleno');
                //enviamos el store
                let token = '{{ csrf_token() }}';
                let nombre = txt_sectore.value;
                let url = "{{ asset('/dashboard/administrador/sectores') }}";
                
                fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ nombre: nombre, _token: token })
                })
                .then(response => response.json())
                .then(data => {
                    // Aquí puedes manejar la respuesta recibida desde Laravel
                    //var objeto = JSON.parse(data);
                    console.log(data.id);
                    let selectsectore = document.getElementById('sector');
                    let row = document.createElement("option");
                    row.value = data.id;
                    row.innerHTML= data.nombre;
                    console.log(row);
                    selectsectore.appendChild(row);
                    //ocultar el 
                    let card = document.getElementById("card_sectore");
                    card.style.display = "none";
                })
                .catch(error => {
                    // Aquí puedes manejar cualquier error que ocurra durante la petición
                    console.log(error);
                    //console.error(error);
                });
            }
        });
    </script>  
@stop