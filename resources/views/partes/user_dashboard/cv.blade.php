{{-- <div class="col-sm-12 mt-3">
    <div class="left-text">
        <h4>CV - Hoja de vida descriptiva</h4>
    </div>
    {!! Form::open() !!}
    <div class="card">
        <div class="card-header">
            <h5>Registrar Experiencia Laboral</h5>
        </div>
        <div class="card-body">

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
            </button>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="table-responsive">
        <table class="table">
            <thead></thead>
        </table>
    </div>
</div>
 --}}

 <div>
    <div class="thumb">
      <div class="row">
        <div class="col-lg-12 align-self-center">
          <div class="left-text">
            <h4>Hoja de vida no documentada </h4>
            <p>agrega tus experiencias laborales y o capacitaciones que poeseas</p>
            <div class="card">
                <div class="card-header">
                    <h6>
                        <button class="btn btn-secondary" id="btn_ex">
                            <i id="ex_icon" class="fa fa-plus" aria-hidden="true"></i>
                        </button> 
                        Agregar Experiencia Laboral
                    </h6>
                </div>
                <div class="card-body d-none" id="exbody">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Empresa</label>
                            <input type="text" id="empresa" class="form-control" placeholder="ingrese nombre de la empresa">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="mt-2">Inicio</label>
                            <input type="date" id="xfinicio" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="mt-2">Fin</label>
                            <input type="date" id="xffin" class="form-control">
                            <span>
                                <small>
                                    trabajo actual
                                </small>
                                <input type="checkbox" id="actual" class="mt-2">
                            </span>
                            
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="mt-2">Cargo</label>
                            <input type="text" id="cargo" class="form-control" placeholder="puesto ocupado">
                        </div>
                    </div>
                </div>
                <div class="card-footer d-none" id="exfooter">
                    <button type="button" class="btn btn-info" id="btn_experiencia">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                    </button>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h6>
                        <button class="btn btn-secondary" id="btn_cu">
                            <i id="cu_icon" class="fa fa-plus" aria-hidden="true"></i>
                        </button> 
                        Cursos o Capacitaciones
                    </h6>
                </div>
                <div class="card-body d-none" id="cubody">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Institución Formadora</label>
                            <input id="institucion" type="text" class="form-control" placeholder="ingrese nombre del centro de estudios" required>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label for="">Mension o Tema</label>
                            <input id="mension" type="text" class="form-control" placeholder="ingrese nombre del tema o la capacitación" required>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="mt-2">Inicio</label>
                            <input id="cuinicio" type="date" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="mt-2">Fin</label>
                            <input id="cufin" type="date" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="mt-2">Horas o Créditos</label>
                            <input type="text" id="horas" class="form-control">
                        </div>
                    </div>                    
                </div>
                <div class="card-footer d-none" id="cufooter">
                    <button type="button" class="btn btn-info" id="btn_curso">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                    </button>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="4">Experencia Laboral</th>
                        </tr>
                        <tr>
                            <th>Empresa</th>
                            <th>Cargo</th>
                            <th>F Inicio</th>
                            <th>F Fin</th>
                        </tr>
                    </thead>
                    <tbody id="table_experiencias">

                    </tbody>
                </table>
            </div>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="5">Cursos y Capacitaciones</th>
                        </tr>
                        <tr>
                            <th>Nombre / Mension</th>
                            <th>Institución Formadora</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Horas / Creditos</th>
                        </tr>
                    </thead>
                    <tbody id="table_cursos">
                        
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>
 