<!-- Modal -->
@props(['id','title'=>'Modal Confirmacion','theme'=>'primary','icon'=>null,'send'=>false,'route'=>null,'method'=>null,'parameter'=>null])
<div class="modal fade" id="modal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-{{ $theme }}">
          <h5 class="modal-title" id="exampleModalLabel"><i class="{{ $icon }}"></i> {{ $title }}</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        @if ($send == true)
          @if(isset($parameter))
            {!! Form::open(['route'=>[$route,$parameter],'method'=>$method]) !!}
          @else
            {!! Form::open(['route'=>$route,'method'=>$method]) !!}
          @endif
        @endif
        <div class="modal-body">
            <div class="row">
                {{ $slot }}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
          @if ($send == true)
            <button type="submit" class="btn btn-{{ $theme }}"><i class="fa fa-share-square-o"></i> Enviar</button>
          @endif
        </div>
        @if ($send == true)
          {!! Form::close() !!}
        @endif
      </div>
    </div>
</div>