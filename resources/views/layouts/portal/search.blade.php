<div id="free-quote" class="free-quote">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
            <h4>Explora las ofertas laborales que tenemos para ti</h4>
            {{-- <div class="line-dec"></div> --}}
          </div>
        </div>
        <div class="col-lg-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
            {!! Form::open(['route'=>'empleos_search','method'=>'post']) !!}
            <div class="row">
              <div class="col-sm-5">
                <input type="text" name="searchText" placeholder="Ingrese palabra clave">
              </div>
              {{-- <div class="col-sm-3">
                <select name="location">
                  <option value="0">Ubicacion</option>
                  @foreach ($ubicaciones as $ubicacione)
                      <option value="{{ $ubicacione->id }}">{{ $ubicacione->nombre }} @if ($ubicacione->ubicacione_id == null) - Departamento @else @if($ubicacione->padre->padre == null) - Provincia @endif @endif</option>
                  @endforeach
                </select>
                @error('location')
                  <small class="text-danger mt-2">{{ $message }}</small>
                @enderror
              </div> --}}
              <div class="col-sm-5">
                <select name="carrera">
                  <option value="0">Programa de Estudios</option>
                  @foreach ($carreras as $carrera)
                      <option value="{{ $carrera->idCarrera }}">{{ $carrera->nombreCarrera }}</option>
                  @endforeach
                </select>
                @error('carrera')
                  <small class="text-danger mt-2">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-lg-2 col-sm-2">
                  <button type="submit" class="main-button"><i class="fa fa-search" aria-hidden="true"></i> Buscar ahora</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>