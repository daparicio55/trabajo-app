<x-Modal :id="$postulacione->id.'-show'" title="Mostrando Detalles">
    @foreach ($postulacione->user->ucliente->cliente->postulantes as $postulante)
        @if(isset($postulante->estudiante->id))
           {!! Form::label(null, 'Programa de Estudios', [null]) !!}
           {!! Form::text(null, $postulante->carrera->nombreCarrera, ['class'=>'form-control','readonly']) !!}
           {!! Form::label(null, 'Año de Ingreso', ['class'=>'mt-2']) !!}
           {!! Form::text(null, $postulante->admisione->nombre, ['class'=>'form-control','readonly']) !!}
        @endif
    @endforeach
</x-Modal>