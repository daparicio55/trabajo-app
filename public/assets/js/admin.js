//validar que no este vacio
function validar(dni){
    if(dni.length != 8){
        alert("Debe tener almenos 8 digitos");
        return false;

    }
    return true;
}
document.getElementById('btn_buscar').addEventListener('click',function(){
    //vamos a buscar
    var dni = document.getElementById('searchText');
    if (validar(dni.value)){
        //longitud de la cadena ahora vamos a buscar     
        fetch(url+'api/getdatos/'+dni.value)
        .then(response =>{
            if(!response.ok){
                throw new Error(`Error en la solicitud: ${response.status} ${response.statusText}`);
            }
            return response.json();
        }).then(data =>{
            console.log(data);
            if(data.error == "ya es estudiante"){
                console.log('error');
            }else{
                document.getElementById('cliente').value=data.idCliente;
                document.getElementById('apellido').value=data.apellido;
                document.getElementById('nombre').value=data.nombre;
                document.getElementById('telefono').value=data.telefono;
                document.getElementById('telefono2').value=data.telefono2;
                document.getElementById('email').value=data.email;
            }
        }).catch(error =>{
            console.error('Error',error);
        });
    }
});






