<x-Modal :id="$empleo->id.'-delete'" title="Eliminar Oferta Empleo" theme="danger" icon="far fa-trash-alt" send=true route="dashboard.empleos.destroy" method="delete" :parameter="$empleo->id">
    <p>¿Esta seguro que desea elminar esta empleo del sistema?</p>
</x-Modal>