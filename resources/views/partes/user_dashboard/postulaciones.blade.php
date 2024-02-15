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