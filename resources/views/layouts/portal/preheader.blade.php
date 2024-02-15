<!-- Pre-header Starts -->
<div class="pre-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-sm-7">
          <ul class="info">
            <li><a href="#"><i class="fa fa-envelope"></i>{{ env('MAIL_FROM_ADDRESS') }}</a></li>
            <li><a href="#"><i class="fa fa-phone"></i>{{ env('PHONE_NUMBER') }}</a></li>
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