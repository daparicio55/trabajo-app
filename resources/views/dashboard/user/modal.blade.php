<x-Modal :id="$postulacione->id.'-eliminar'" title="Eliminar Postulacion" theme="danger" icon="far fa-trash-alt" send=true route="dashboard.postulaciones.destroy" method="delete" :parameter="$postulacione->id">
    <p>¿Esta seguro que desea elminar este registro?</p>
</x-Modal>
<x-Modal :id="$postulacione->id.'-detalles'" title="Detalles de la Oferta Laboral" theme="info" icon="fas fa-eye">
    <div class="row">
        <div class="col-sm-12">
            {!! Form::label(null, "Descripcion", [null]) !!}
            {!! $postulacione->empleo->descripcion !!}
            {!! Form::label(null, 'Cierre', [null]) !!}
            <p>{{ date('d-m-Y',strtotime($postulacione->empleo->fecha_postulacion)) }}</p>
            {!! Form::label(null, "Detalles Empresa", [null]) !!}
            <ul>
                <li><strong>Contacto(s):</strong> {{ $postulacione->empleo->empresa->contacto1 }}, {{ $postulacione->empleo->empresa->contacto2 }}</li>
                <li><strong>Telefono(s):</strong> {{ $postulacione->empleo->empresa->telefono1 }}, {{ $postulacione->empleo->empresa->telefono2 }}</li>
                <li><strong>Correo(s):</strong> {{ $postulacione->empleo->empresa->email }}</li>
            </ul>
        </div>
    </div>
</x-Modal>