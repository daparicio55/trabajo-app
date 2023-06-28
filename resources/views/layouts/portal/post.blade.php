<div id="blog" class="blog">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
          <div class="section-heading">
            <h6>reviza lo nuevo</h6>
            <h4>Nuevos Empleos</h4>
            <div class="line-dec"></div>
          </div>
        </div>
        <div class="col-lg-6 show-up wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
          <div class="blog-post">
            <div class="thumb">
              <a href="#"><img src="assets/images/blog-post-01.jpg" alt=""></a>
            </div>
            <div class="down-content">
              <span class="category"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Noticias</span>
              <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> 03 de Agosto del 2021</span>
              <a href="#"><h4>Presentación de nueva plataforma de Empleabilidad</h4></a>
              <p>Te presentamos nuestra nueva plataforma de empleo, diseñada para ayudarte a encontrar oportunidades laborales de manera más efectiva. Con nuestra plataforma, podrás acceder a una amplia variedad de ofertas de trabajo y recibir notificaciones personalizadas según tus preferencias.</p>
              <span class="author"><img src="{{ asset('assets/images/dave-pic.jpg') }}" alt="">Por: Davis Aparicio Palomino</span>
              <div class="border-first-button"><a href="#">Enterate de más..</a></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
          <div class="blog-posts">
            <div class="row">
              @foreach ($empleos as $empleo)
                <div class="col-lg-12">
                  <div class="post-item">
                    <div class="thumb">
                      {{-- <a href="#"><img src="assets/images/blog-post-02.jpg" alt=""></a> --}}
                    </div>
                    <div class="right-content">
                      <a href="{{ route('empleo',$empleo->id) }}"><h4>{{ $empleo->titulo }}</h4></a>
                      <span class="category"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $empleo->ubicacione->nombre  }} - {{ $empleo->ubicacione->padre->nombre }} - {{ $empleo->ubicacione->padre->padre->nombre }}</span>
                      <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('d - M - Y',strtotime($empleo->fecha_registro)) }}</span>
                      
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  