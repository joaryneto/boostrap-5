<section class="row component-section">
    <div class="col-md-12"> 
        <div class="component-box">
    <!--<div class="content-sticky-footer">
        <div class="background bg-170"><img src="img/background.png" alt=""></div>
            <div class="w-100">
                @auth
                <h1 class="text-center text-white title-background"><small>Bem vindo,<br></small> {{auth()->user()->name}} </h1>
                @endauth
                    <div class="carosel">
                        <div class="swiper-container swiper-init swipermultiple">
                            <div class="swiper-pagination"></div>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper-content-block ">
                                        <h4 class="title-small-carousel">Atividades Realizadas</h4>
                                        <p>Agosto</p>
                                        <div class="gaugewrap">
                                            <h2 class="title-number-carousel"><span class="text-primary">{{ $dados_index->respondido }}</span><small> Gincana SuperAção</small></h2>
                                            <div class="progress_profile1 gauge" data-value="0.65" data-size="20" data-thickness="2" data-animation-start-value="0" data-reverse="false"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-content-block ">
                                        <h4 class="title-small-carousel">Falta Realizar</h4>
                                        <p>Novembro</p>
                                        <div class="gaugewrap">
                                            <h2 class="title-number-carousel"><span class="text-danger">{{ $dados_index->nao }}</span><small> Gincana SuperAção</small></h2>
                                            <div class="progress_profile2  gauge" data-value="0.65" data-size="20" data-thickness="2" data-animation-start-value="0" data-reverse="false"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
 <div class="row mb-3">
    <div class="col-md-12">
            <div class="card pmd-card">
                <h2 class="block-title" style="line-height: initial;font-size: 30px;">TOP 10</h2>
                <ul class="list-group">
                    @foreach($dados_classe as $p)
                    <li class="list-group-item">
                        <a href="#" class="media">
                            <div class="media-body">
                                <h5>{{ $p->titulo }}</h5>
                                <h2 class="title-number-carousel color-primary"><span class="text-primary">{{ $p->total =  $p->total == null ? 0:$p->total; }}</span><small> Pontos</small></h2>
                            </div>
                            <div class="avatar avatar-40" style="border-radius:15px;">
                                <img src="{{ asset('assets/img/logo2.png') }}" alt="" style="border-radius: inherit;">
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <br>
            </div>
        </div>
    </div>
  </div>
</div>   
</section>