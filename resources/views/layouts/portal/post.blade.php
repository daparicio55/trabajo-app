<div id="blog" class="blog">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 offset-lg-12  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="section-heading">
          <h6>revisa lo nuevo</h6>
          <h4>Nuevas Ofertas Laborales</h4>
          <div class="line-dec"></div>
        </div>
      </div>
      <div class="col-lg-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
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