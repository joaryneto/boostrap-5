<section class="row component-section">
    <div class="col-md-12"> 
        <div class="component-box">
            <h2 class="block-title" style="line-height: initial;font-size: 30px;">Ranking</h2>
            <div class="row">
            @foreach($dados_classe as $key => $p)
            <div class="col-md-6 col-lg-6">
                <div class="card pmd-card mb-4" style="margin-bottom: 10px;">
                    <!-- Card body -->
                    <div class="card-body media align-items-center">
                        <img alt="profile-pic" src="{{ asset('assets/img/logo2.png') }}" class=" mr-3" style="max-width: 80px;">
                        <div class="media-body">
                            <h3 class="card-title">{{ $key+1  }}° - {{ $p->titulo }}</h3>
                            <p class="mb-0 card-subtitle"> {{ $p->nome_igreja }} </p>
                            <p class="mb-0 card-subtitle">
                                <strong>{{ $p->total =  $p->total == null ? 0:$p->total; }}</strong> Pontos
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>   
    </div>
</section>