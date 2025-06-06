@section('css')
    <style>
        .btn-celeste{
            background-color: rgb(77, 166, 231);
            color: white;
        }
    </style>
@endsection
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
            
            <div class="col-lg-6 show-up wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                @if (isset($empleos[0]->id))
                    <div class="blog-post">
                        <div class="thumb">
                            <a href="#"><img src="{{ Storage::url($empleos[0]->pic) }}" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">{{ $empleos[0]->empresa->razonSocial }}</span>
                            {{-- <span class="date">{{ date('d - M - Y',strtotime($empleos[0]->fecha_registro)) }}</span> --}}
                            <span class="date">
                                {{ date('d', strtotime($empleos[0]->fecha_registro)) }} {{ __(date('F', strtotime($empleos[0]->fecha_registro))) }} {{ date('Y', strtotime($empleos[0]->fecha_registro)) }}
                            </span>
                            <a href="{{ route('empleo',$empleos[0]->id) }}">
                                <h4>{{ $empleos[0]->titulo }}</h4>
                            </a>
                            {{-- <p>{!! Str::limit($empleos[0]->descripcion, 150, '...')  !!}</p> --}}
                            <span class="author"><img src="assets/images/author-posta.jpg" alt="">Por: {{ $empleos[0]->user->name }}</span>
                            <div class="border-first-button"><a href="{{ route('empleo',$empleos[0]->id) }}">Ver más</a></div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                <div class="blog-posts">
                    <div class="row">
                      @foreach ($empleos as $key=>$empleo)
                        @if (!$loop->first)
                          <div class="col-lg-12 mb-1">
                              <div class="post-item border rounded-3 p-3 shadow">
                                  <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <a href="{{ route('empleo',$empleo->id) }}">
                                            <img src="{{ Storage::url($empleo->pic) }}" alt="{{ $empleo->pic }}">
                                        </a>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                      <div class="right-content">
                                      <span class="category">{{ Str::limit($empleo->empresa->razonSocial, 45, '...')  }}</span>
                                      <span class="date">
                                        {{ date('d', strtotime($empleo->fecha_registro)) }} {{ __(date('F', strtotime($empleo->fecha_registro))) }} {{ date('Y', strtotime($empleo->fecha_registro)) }}
                                      </span>
                                      <a href="{{ route('empleo',$empleo->id) }}">
                                          <h4>{{ $empleo->titulo }}</h4>
                                      </a>
                                      <a class="btn btn-celeste btn-sm" href="{{ route('empleo',$empleo->id) }}">
                                        <i class="fa fa-eye"></i> Ver más ...
                                      </a>
                                  </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          @endif
                      @endforeach            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
