<div class="page-content">
    <div class="content-sticky-footer">
        <div class="background bg-170"><img src="img/background.png" alt=""></div>
        <div class="row mx-0 userblock-ht">
            <div class="col mt-4">
                <a href="#" class="media">
                    <div class="w-auto h-100">
                        <figure class="avatar avatar-120">
                            @if(auth()->user()->foto != null)
                            <img src="{{ asset('assets/img/perfil/'.auth()->user()->cpf.'/'.auth()->user()->cpf.'.jpg') }}" alt="">
                            @else
                            <img src="{{ asset('assets/img/logo.jpg') }}" alt="">
                            @endif
                        </figure>
                    </div>
                    <div class="media-body align-self-center ">
                        <h5 class="text-white">{{auth()->user()->name}}<span class="status-online bg-success"></span></h5>
                        <p class="text-white">
                            online <span class="status-online bg-color-success"></span>
                            <br> {{auth()->user()->username}}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <h2 class="block-title">Sobre</h2>
        <div class="row mx-0">
            <div class="col">
                <p>.</p>
            </div>
        </div>
        <h2 class="block-title">Projeto participantes</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="#" class="media">
                    <div class="media-body">
                        <h5>Gincana SuperAção</h5>
                        <p>Agosto a Novembro</p>
                        <h2 class="title-number-carousel color-primary"><span class="text-primary">0</span><small> Pontos</small></h2>
                    </div>
                    <div class="avatar avatar-120" style="border-radius:15px;">
                        <img src="{{ asset('assets/img/logo2.png') }}" alt="" style="border-radius: inherit;">
                    </div>
                </a>
            </li>
        </ul>
        <h2 class="block-title">Membros</h2>
        <div class="row mx-0">
            <div class="col">
                <figure class="avatar avatar-40" data-toggle="tooltip" data-placement="top" title="Maxwell Vieira"><img src="{{ asset('assets/img/perfil/11537358065/11537358065.jpg') }}" alt=""> </figure>
            </div>
        </div>
        <br>
        <h2 class="block-title">Últimos Comentários</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="#" class="media">
                    <div class="w-auto h-100">
                        <figure class="avatar avatar-40"><img src="{{ asset('assets/img/perfil/'.auth()->user()->cpf.'/'.auth()->user()->cpf.'.jpg') }}" alt=""> </figure>
                    </div>
                    <div class="media-body">
                        <h5>Joary Taques <span class="status-online bg-success"></span></h5>
                        <p>Muito bom fazer parte da Equipe... </p>
                    </div>

                </a>
            </li>
        </ul>
        <br>
    </div>
    <div class="footer-wrapper">
        <div class="footer">
            <div class="row mx-0">
                <div class="col">
                </div>
                <div class="col-7 text-right">
                    <a href="" class="social"><img src="img/facebook.png" alt=""></a>
                    <a href="" class="social"><img src="img/googleplus.png" alt=""></a>
                    <a href="" class="social"><img src="img/linkedin.png" alt=""></a>
                    <a href="" class="social"><img src="img/twitter.png" alt=""></a>
                </div>
            </div>
        </div>
        <div class="footer dark">
            <div class="row mx-0">
                <div class="col text-center">
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>