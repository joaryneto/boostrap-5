<section class="row component-section">
    <div class="col-md-12"> 
        <div class="component-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="card pmd-card">
                        <h2 class="block-title" style="line-height: initial;font-size: 30px;">TOP 10</h2>
                        <ul class="list-group">
                            @foreach($dados_classe as $p)
                            <li class="list-group-item">
                                <a href="#" class="media">
                                    <div class="media-body">
                                        <h5>{{ $p->titulo }}</h5>
                                        <p>{{ $p->nome_igreja }}</p>
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