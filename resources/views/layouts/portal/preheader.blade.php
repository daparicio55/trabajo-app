<!-- Pre-header Starts -->
<div class="pre-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-sm-7">
          <ul class="info">
            <li><a href="mailto:soporte@idexperujapon.edu.pe"><i class="fa fa-envelope"></i> soporte@idexperujapon.edu.pe</a></li>
            <li><a href="#"><i class="fa fa-phone"></i> 042-587458</a></li>
            <li><a href="https://wa.link/8uq9v3"><i class="fa fa-whatsapp" aria-hidden="true"></i> 971724913</a></li>
          </ul>
        </div>
        <div class="col-lg-5 col-sm-5">
          <ul class="social-media">
            @auth
              @if (Auth::user()->hasRole("Bolsa User"))
                <li>{{ Auth::user()->name }} -</li>
                <li><b>Estudiante</b></li>            
              @endif
              @if (Auth::user()->hasRole("Docentes"))
                <li><b>Docente</b></li>            
              @endif
            @endauth
            <li><a href="{{ env('FACEBOOK_URL') }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Pre-header End -->