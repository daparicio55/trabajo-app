@extends('layouts.portal.base')
@section('contenido')
    @include('layouts.portal.preheader')
    @include('layouts.portal.header')
    <div class="services section">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                {{-- <h6>Our Services</h6> --}}
                <h4>Panel <em> Control</em></h4>
                <div class="line-dec"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="naccs">
                <div class="grid">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="menu">
                        <div class="first-thumb active">
                          <div class="thumb">                 
                            <span class="icon"><img src="{{ asset('assets/images/demandante-de-empleo.png') }}" alt=""></span>
                            Ofertas
                          </div>
                        </div>
                        <div>
                          <div class="thumb">                 
                            <span class="icon"><img src="{{ asset('assets/images/headhunting.png') }}" alt=""></span>
                            Postulaciones
                          </div>
                        </div>
                        <div>
                          <div class="thumb">
                            <span class="icon"><img src="{{ asset('assets/images/panel-de-administrador.png') }}" alt=""></span>
                            Datos
                          </div>
                        </div>
                        <div>
                          <div class="thumb">
                            <span class="icon"><img src="{{ asset('assets/images/cv.png') }}" alt=""></span>
                            Hoja de Vida
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="col-lg-12">
                      <ul class="nacc">
                        <!-- ofertas segun programa de estudios -->
                        <li class="active" style="padding-left: 25px; padding-right: 25px">
                          @include('partes.user_dashboard.ofertas')
                        </li>
                        <li>
                          @include('partes.user_dashboard.postulaciones')
                        </li>
                        <li>
                          @include('partes.user_dashboard.datos')
                        </li>
                        <li>
                          @include('partes.user_dashboard.cv')
                        </li>
                      </ul>
                    </div>          
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @include('layouts.portal.footer')
@stop
@section('js')
@if(session('info'))
    @php
        $message1 = session('info');
    @endphp
    <script> 
        toastr.options  = {
            "progressBar" : true,
            "timeOut": 7000,
            }
            toastr.success('{{ $message1 }}');
    </script>
    @endif
    @if (session('error'))
    @php
        $message2 = session('error');
    @endphp
    <script> 
        toastr.options  = {
            "progressBar" : true,
            }
            toastr.error('{{ $message2 }}');
    </script>
    @endif
    <script>
      fillex();
      fillcur();
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      // llenar la tabla de experiencias
      function fillex(){
        const url = "{{ route('dashboard.index_experiencia') }}";
        fetch(url)
        .then(response => response.json())
        .then(data => {
          // agregamos los datos a la tabla
          data.forEach(element => {
            let tabla = document.getElementById('table_experiencias');
            let fila = document.createElement('tr');
            let c_empresa = document.createElement('td');
            let c_cargo = document.createElement('td');
            let c_inicio = document.createElement('td');
            let c_fin = document.createElement('td');
            let c_boton = document.createElement('td');
            let btn = document.createElement('button');
            //configuramos el boton
            btn.type = "button";
            btn.classList.add('btn');
            btn.classList.add('btn-danger');
            btn.innerHTML = "<i class='fa fa-trash'></i>";
            const fun = 'ex_eliminar("'+ element.id +'")';
            btn.setAttribute('onclick',fun);
            c_boton.appendChild(btn);
            //agregamos los valores
            c_empresa.innerHTML = element.empresa;
            c_cargo.innerHTML = element.cargo;
            c_inicio.innerHTML = element.exinicio;
            if(element.actual == 1){
              c_fin.innerHTML = "Actual";
            }else{
              c_fin.innerHTML = element.exfin;
            };
            fila.appendChild(c_empresa);
            fila.appendChild(c_cargo);
            fila.appendChild(c_inicio);
            fila.appendChild(c_fin);
            fila.appendChild(c_boton);
            tabla.appendChild(fila);
          });
        })
        .catch(error =>{
          console.error('error al enviar la solicitud',error);
        });
      }
      function fillcur(){
        const url = "{{ route('dashboard.index_curso') }}";
        fetch(url)
        .then(response => response.json())
        .then(data => {
          // agregamos los datos a la tabla
          data.forEach(element => {
            let tabla = document.getElementById('table_cursos');
            let fila = document.createElement('tr');
            let c_mension = document.createElement('td');
            let c_institucion = document.createElement('td');
            let c_inicio = document.createElement('td');
            let c_fin = document.createElement('td');
            let c_horas = document.createElement('td');
            let c_boton = document.createElement('td');
            let btn = document.createElement('button');
            //configuramos el boton
            btn.type = "button";
            btn.classList.add('btn');
            btn.classList.add('btn-danger');
            btn.innerHTML = "<i class='fa fa-trash'></i>";
            const fun = 'cur_eliminar("'+ element.id +'")';
            btn.setAttribute('onclick',fun);
            c_boton.appendChild(btn);
            //agregamos los valores
            c_mension.innerHTML = element.mension;
            c_institucion.innerHTML = element.institucion;
            c_inicio.innerHTML = element.inicio;
            c_fin.innerHTML = element.fin;
            c_horas.innerHTML = element.horas;
            //agregamos
            fila.appendChild(c_mension);
            fila.appendChild(c_institucion);
            fila.appendChild(c_inicio);
            fila.appendChild(c_fin);
            fila.appendChild(c_horas);
            fila.appendChild(c_boton);
            tabla.appendChild(fila);
          });
        })
        .catch(error =>{
          console.error('error al enviar la solicitud',error);
        });
      }
      //funcion para borrar la tabla
      function cleartable(nombre) {
        // Obtén la cantidad total de filas en la tabla
        var tbody = document.getElementById(nombre);

        // Elimina todas las filas del tbody
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
      }
      
      function ex_eliminar(id){
        $('#js-preloader').removeClass('loaded');
        //vamos a eliminar
        const url = '{{ asset('') }}'+'dashboard/experiencia/'+id;
        const requestOptions = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                // Puedes agregar más encabezados si es necesario
                'X-CSRF-TOKEN': csrfToken, // Incluir el token CSRF en el encabezado
            },
        };

        fetch(url, requestOptions)
        .then(response => {
            // Verificar si la respuesta fue exitosa (código 2xx)
            if (!response.ok) {
                throw new Error(`Error al eliminar el usuario. Código: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Manejar la respuesta del servidor aquí
        })
        .catch(error => {
            // Manejar errores de la solicitud aquí
            console.error('Error al enviar la solicitud:', error);
        })
        .finally(()=>{
          cleartable('table_experiencias');
          fillex();
          $('#js-preloader').addClass('loaded');
        });

      }
      //funcion eliminar
      function cur_eliminar(id){
        $('#js-preloader').removeClass('loaded');
        const url = '{{ asset('') }}'+'dashboard/curso/'+id;
        const requestOptions = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                // Puedes agregar más encabezados si es necesario
                'X-CSRF-TOKEN': csrfToken, // Incluir el token CSRF en el encabezado
            },
        };

        fetch(url, requestOptions)
        .then(response => {
            // Verificar si la respuesta fue exitosa (código 2xx)
            if (!response.ok) {
                throw new Error(`Error al eliminar el usuario. Código: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Manejar la respuesta del servidor aquí
        })
        .catch(error => {
            // Manejar errores de la solicitud aquí
            console.error('Error al enviar la solicitud:', error);
        })
        .finally(()=>{
          cleartable('table_cursos');
          fillcur();
          $('#js-preloader').addClass('loaded');
        });
      }

      document.getElementById('btn_ex').addEventListener('click',function(){
        if($('#ex_icon').hasClass('fa-minus')){
          //ocultamos
          $('#exbody').addClass('d-none');
          $('#exfooter').addClass('d-none');
          $('#ex_icon').removeClass('fa-minus');
          $('#ex_icon').addClass('fa-plus');
        }else{
          $('#exbody').removeClass('d-none');
          $('#exfooter').removeClass('d-none');
          $('#ex_icon').removeClass('fa-plus');
          $('#ex_icon').addClass('fa-minus');
        }
      });

      document.getElementById('btn_cu').addEventListener('click',function(){
        if($('#cu_icon').hasClass('fa-minus')){
          //ocultamos
          $('#cubody').addClass('d-none');
          $('#cufooter').addClass('d-none');
          $('#cu_icon').removeClass('fa-minus');
          $('#cu_icon').addClass('fa-plus');
        }else{
          $('#cubody').removeClass('d-none');
          $('#cufooter').removeClass('d-none');
          $('#cu_icon').removeClass('fa-plus');
          $('#cu_icon').addClass('fa-minus');
        }
      });

      document.getElementById('btn_experiencia').addEventListener('click',function(){
        $('#js-preloader').removeClass('loaded');
        const url = "{{ route('dashboard.store_experiencia') }}";
        
        let check = false;
        if (document.getElementById('actual').checked){
          check = true;
        }
        const data = {
          user: "{{ auth()->user()->id }}",
          empresa: document.getElementById('empresa').value,
          xfinicio: document.getElementById('xfinicio').value,
          xffin: document.getElementById('xffin').value,
          actual: check,
          cargo: document.getElementById('cargo').value,
        };
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Incluir el token CSRF en el encabezado
                // Puedes agregar más encabezados si es necesario
            },
            body: JSON.stringify(data),
        };

        fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor aquí
            cleartable('table_experiencias');
            fillex();
        })
        .catch(error => {
            // Manejar errores de la solicitud aquí
            console.error('Error al enviar la solicitud:', error);
        })
        .finally(()=>{
          $('#js-preloader').addClass('loaded');
          //limpiar las cajas
          document.getElementById('empresa').value = "";
          document.getElementById('xfinicio').value = "";
          document.getElementById('xffin').value = "";
          document.getElementById('cargo').value = "";
          document.getElementById('actual').checked = false;
        });
      });

      //Botones de CURSOS

      document.getElementById('btn_curso').addEventListener('click',function(){
        $('#js-preloader').removeClass('loaded');
        const url = "{{ route('dashboard.store_curso') }}";
        const data = {
          institucion: document.getElementById('institucion').value,
          mension: document.getElementById('mension').value,
          cuinicio: document.getElementById('cuinicio').value,
          cufin: document.getElementById('cufin').value,
          horas: document.getElementById('horas').value,
        };
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Incluir el token CSRF en el encabezado
                // Puedes agregar más encabezados si es necesario
            },
            body: JSON.stringify(data),
        };

        fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor aquí
            cleartable('table_cursos');
            fillcur();
        })
        .catch(error => {
            // Manejar errores de la solicitud aquí
            console.error('Error al enviar la solicitud:', error);
        })
        .finally(()=>{
          $('#js-preloader').addClass('loaded');
          //limpiar las cajas
          document.getElementById('institucion').value = "";
          document.getElementById('mension').value = "";
          document.getElementById('cuinicio').value = "";
          document.getElementById('cufin').value = "";
          document.getElementById('horas').value = "";
        });
      });

    </script>
@stop