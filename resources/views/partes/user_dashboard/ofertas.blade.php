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