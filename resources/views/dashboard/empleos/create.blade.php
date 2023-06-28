@extends('adminlte::page')

@section('title', 'Registrar Empleo')

@section('content_header')
    <h1>Registrar Empleo</h1>
@stop
@section('content')
    {{-- {!! Form::open(['route'=>'dashboard.administrador.empresas.store','method'=>'post','id'=>'frm']) !!} --}}
    {!! Form::open(['route'=>'dashboard.empleos.store','method'=>'post','id'=>'frm']) !!}
    <div class="card">
        <div class="card-header bg bg-info">
            <a href="{{ route('dashboard.administrador.empresas.index') }}" class="btn btn-danger">
                <i class="fas fa-backward" title="regresar"></i>
            </a> 
                <h4 class="d-inline p-2">Datos del Empleo</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-10">
                    {!! Form::label('empresa', 'Empresa', [null]) !!}
                    {!! Form::select('empresa', $empresas, null, ['class'=>'form-control selectpicker','data-live-search'=>"true",'data-size'=>"5"]) !!}
                    @error('empresa')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('titulo', 'Titulo', ['class'=>'mt-4']) !!}
                    {!! Form::textarea('titulo', old('titulo'), ['class'=>'form-control','rows'=>'3']) !!}
                    @error('titulo')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('descripcion', 'Descripcion', ['class'=>'mt-4']) !!}
                    @php
                    $config = [
                        "height" => "200",
                        "toolbar" => [
                            // [groupName, [list of button]]
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['table', ['table']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview', 'help']],
                        ],
                    ]
                    @endphp
                    <x-adminlte-text-editor name="descripcion" id label-class="text-danger" igroup-size="sm" placeholder="describa la informacion sobre el empleo..." :config="$config">
                        {{ old('descripcion') }}
                    </x-adminlte-text-editor>

                    {!! Form::label('experiencia', 'Experiencia', [null]) !!}
                    <x-adminlte-input-switch name="experiencia" data-on-text="SI" data-off-text="NO" data-on-color="teal" checked/>
                    {!! Form::label('turno', 'Turno', [null]) !!}
                    {!! Form::select('turno', $turnos, null, ['class'=>'form-control selectpicker','data-live-search'=>'true','data-size'=>'5']) !!}
                    {!! Form::label('cierre', 'Fecha de cierre', ['class'=>'mt-3']) !!}
                    {!! Form::date('cierre', old('cierre'), ['class'=>'form-control']) !!}
                    @error('cierre')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('departamentos', 'Departamento', ['class'=>'mt-3']) !!}
                    <select name="departamentos" id="departamentos" class="form-control">
                        <option value="{{ 0 }}">Seleccione</option>
                    </select>
                    @error('departamentos')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('provincias', 'Provincia', ['class'=>'mt-3']) !!}
                    <select name="provincias" id="provincias" class="form-control">
                        <option value="{{ 0 }}">Seleccione</option>
                    </select>
                    @error('provincias')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('distritos', 'Distrito', ['class'=>'mt-3']) !!}
                    <select name="distritos" id="distritos" class="form-control">
                        <option value="0">Seleccione</option>
                    </select>
                    @error('distritos')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
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
        document.getElementById('frm').addEventListener('submit',function(){

        });
        let ubicaciones = <?php echo $ubicaciones ?>;
        let departamentos = document.getElementById('departamentos');
        let provincias = document.getElementById('provincias');
        let distritos = document.getElementById('distritos');
        function resetprovincias(){
            while (provincias.options.length > 0) {
                provincias.remove(0);
            }
            let row = document.createElement('option');
            row.value = 0;
            row.innerHTML="Seleccione";
            provincias.appendChild(row);
        }
        function resetdistritos(){
            while (distritos.options.length > 0) {
                distritos.remove(0);
            }
            let row = document.createElement('option');
            row.value = 0;
            row.innerHTML="Seleccione";
            distritos.appendChild(row);
        }
        function adddepartamento(){
            //recorremos las ubicaciones
            ubicaciones.forEach(element => {
                if(element.ubicacione_id == null){
                    let row = document.createElement('option');
                    row.value = element.id;
                    row.innerHTML= element.nombre;
                    departamentos.appendChild(row);
                }
            });
        }
        // llenar departamentos
        adddepartamento();
        // llenar provincias
        function addprovincia(id){
            ubicaciones.forEach(element => {
                if(element.ubicacione_id == id){
                    let row = document.createElement('option');
                    row.value = element.id;
                    row.innerHTML = element.nombre;
                    provincias.appendChild(row);
                }
            });
        }
        //llenar distritos
        function adddistrito(id){
            ubicaciones.forEach(element => {
                if(element.ubicacione_id == id){
                    let row = document.createElement('option');
                    row.value = element.id;
                    row.innerHTML = element.nombre;
                    distritos.appendChild(row);
                }
            });
        }
        //funcion de escucha para provicias
        departamentos.addEventListener("change",function(){
            //destruir provincias y distritos
            resetprovincias();
            resetdistritos();
            //llenar privincias
            addprovincia(departamentos.value);
        });
        provincias.addEventListener("change",function(){
            //destruir distritos
            resetdistritos();
            adddistrito(provincias.value);
        });
    </script>
@stop