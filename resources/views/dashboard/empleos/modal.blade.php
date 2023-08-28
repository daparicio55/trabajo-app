<x-Modal :id="$empleo->id.'-delete'" title="Eliminar Oferta Empleo" theme="danger" icon="far fa-trash-alt" send=true route="dashboard.empleos.destroy" method="delete" :parameter="$empleo->id">
    <p>¿Esta seguro que desea elminar esta oferta laboral del sistema?</p>
</x-Modal>
<x-Modal :id="$empleo->id.'-detalles'" title="Mostrando Detalles" theme="warning" icon="fas fa-eye">
    <p style="width: 100%">
        <b>Fecha de Cierre: </b> {{ date('d-m-Y',strtotime($empleo->fecha_postulacion)) }}
     </p>
     <p style="display: block">
         <b>Experiencia: </b> @if($empleo->id) SI @else NO @endif
     </p>
    {!! $empleo->descripcion !!} 
</x-Modal>