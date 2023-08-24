<!-- Pre-header Starts -->
<div class="pre-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-7">
          <ul class="info">
            <li><a href="#"><i class="fa fa-envelope"></i>{{ env('MAIL_FROM_ADDRESS') }}</a></li>
            <li><a href="#"><i class="fa fa-phone"></i>{{ env('PHONE_NUMBER') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-sm-4 col-5">
          <ul class="social-media">
            @auth
              @if (Auth::user()->hasRole("Bolsa User"))
                <li><b>Estudiante</b></li>            
              @endif
              @if (Auth::user()->hasRole("Docentes"))
                <li><b>Docente</b></li>            
              @endif
            @endauth
            <li><a href="{{ env('FACEBOOK_URL') }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
            {{-- <li><a href="#"><i class="fa fa-behance"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-dribbble"></i></a></li> --}} 
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Pre-header End -->