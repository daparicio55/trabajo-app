@extends('adminlte::page')

@section('title', 'Editar Empleo')

@section('content_header')
    <h1>Registrar Empleo</h1>
@stop
@section('content')
    {{-- {!! Form::open(['route'=>'dashboard.administrador.empresas.store','method'=>'post','id'=>'frm']) !!} --}}
    {{-- {!! Form::open(['route'=>'dashboard.empleos.store','method'=>'post','id'=>'frm']) !!} --}}
    {!! Form::model($empleo, ['route'=>['dashboard.empleos.update',$empleo->id],'method'=>'put','id'=>'frm','enctype'=>'multipart/form-data']) !!}
    <div class="card">
        <div class="card-header bg bg-info">
            <a href="{{ route('dashboard.empleos.index') }}" class="btn btn-danger">
                <i class="fas fa-backward" title="regresar"></i>
            </a> 
                <h4 class="d-inline p-2">Datos del Empleo</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-10">
                    @role('Bolsa Administrador')
                        {!! Form::label('empresa', 'Empresa(*)', [null]) !!}
                        {!! Form::select('empresa', $empresas, null, ['class'=>'form-control selectpicker','data-live-search'=>"true",'data-size'=>"5"]) !!}    
                    @endrole
                    @role('Bolsa Empresa')
                        @php
                            $user = App\Models\User::findOrFail(auth()->id());
                        @endphp
                        <input type="hidden" name="empresa" value="{{ $user->uempresa->empresa->idEmpresa }}">
                    @endrole
                    @error('empresa')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('titulo', 'Titulo(*)', ['class'=>'mt-4']) !!}
                    {!! Form::textarea('titulo', old('titulo'), ['class'=>'form-control','rows'=>'3']) !!}
                    @error('titulo')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('descripcion', 'Descripcion(*)', ['class'=>'mt-4']) !!}
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
                        {{ $empleo->descripcion }}
                    </x-adminlte-text-editor>

                    {!! Form::label('experiencia', 'Experiencia(*)', [null]) !!}
                    @if($empleo->experiencia == true)
                        <x-adminlte-input-switch name="experiencia" data-on-text="SI" data-off-text="NO" data-on-color="teal" checked/>
                    @else
                        <x-adminlte-input-switch name="experiencia" data-on-text="SI" data-off-text="NO" data-on-color="teal"/>
                    @endif

                    {!! Form::label('carreras', 'Carreras(*)', [null]) !!}
                    {{-- With prepend slot, lg size, and label --}}
                    @php
                        $config = [
                            "placeholder" => "Seleccione Programas de Estudios...",
                            "allowClear" => false,
                        ];
                    @endphp
                    <x-adminlte-select2 id="carreras" name="carreras[]" label-class="text-danger" igroup-size="md" :config="$config" multiple>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </x-slot>
                        @php
                            $cars = $empleo->carreras;
                            $array = [];
                            foreach ($cars as $car) {
                                # code...
                                array_push($array,$car->carrera_id);
                            }
                        @endphp
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->idCarrera }}" @if(in_array($carrera->idCarrera,$array)) selected @endif>{{ $carrera->nombreCarrera }}</option>
                        @endforeach
                    </x-adminlte-select2>
                    
                    {!! Form::label('empleoturno_id', 'Turno(*)', [null]) !!}
                    {!! Form::select('empleoturno_id', $turnos, null, ['class'=>'form-control selectpicker','data-live-search'=>'true','data-size'=>'5']) !!}
                    {!! Form::label('cierre', 'Fecha de cierre(*)', ['class'=>'mt-3']) !!}
                    {!! Form::date('cierre', $empleo->fecha_postulacion, ['class'=>'form-control']) !!}
                    @error('cierre')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('foto', 'Foto referencial(*)', ['class'=>'mt-3']) !!}
                    {!! Form::file('foto', ['class'=>'form-control']) !!}
                    @error('foto')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('departamentos', 'Departamento(*)', ['class'=>'mt-3']) !!}
                    <select name="departamentos" id="departamentos" class="form-control">
                        <option value="{{ 0 }}">Seleccione</option>
                    </select>
                    @error('departamentos')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('provincias', 'Provincia(*)', ['class'=>'mt-3']) !!}
                    <select name="provincias" id="provincias" class="form-control">
                        <option value="{{ 0 }}">Seleccione</option>
                    </select>
                    @error('provincias')
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                    @enderror
                    {!! Form::label('distritos', 'Distrito(*)', ['class'=>'mt-3']) !!}
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
            <button type="submit" class="btn btn-info" id="btn_submit">
                <i class="far fa-save"></i> Guardar
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@stop
@section('js')
    <script>
        document.getElementById('frm').addEventListener('submit',function(){
            document.getElementById('btn_submit').disabled = true;
        });
        let ubicaciones = <?php echo $ubicaciones; ?>;
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
        //actualizamos el departamento
        document.getElementById('departamentos').value =  <?php echo $empleo->ubicacione->padre->padre->id; ?>;
        resetprovincias();
        resetdistritos();
        addprovincia(departamentos.value);
        document.getElementById('provincias').value = <?php echo $empleo->ubicacione->padre->id; ?>;
        resetdistritos();
        adddistrito(provincias.value);
        document.getElementById('distritos').value = <?php echo $empleo->ubicacione->id; ?>;
    </script>
@stop