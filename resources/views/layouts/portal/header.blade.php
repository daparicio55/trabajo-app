 <!-- ***** Header Area Start ***** -->
 <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="{{ route('home') }}" class="logo">
              <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/04/logo-300x93.png" style="max-height: 55px" alt="">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="{{ route('home') }}" class="active"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
              {{-- <li class="scroll-to-section"><a href="#about">About</a></li>
              <li class="scroll-to-section"><a href="#services">Services</a></li>
              <li class="scroll-to-section"><a href="#portfolio">Projects</a></li> --}}
              <li class="scroll-to-section"><a href="{{ route('bussines_create') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Empresas</a></li> 
              <li class="scroll-to-section"><a href="{{ route('user_create') }}"><i class="fa fa-plus-square" aria-hidden="true"></i> Egresados</a></li>
              <li class="scroll-to-section">
                @if(null !== auth()->id())
                <div class="border-first-button">
                  <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Panel
                  </a>
                </div>
                @else
                  <div class="border-first-button">
                    <a href="{{ route('dashboard.index') }}">
                      <i class="fa fa-sign-in" aria-hidden="true" title="ingreso de alumnos"></i> Ingresar
                    </a>
                  </div>
                @endif
              </li> 
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
</header>
  <!-- ***** Header Area End ***** -->