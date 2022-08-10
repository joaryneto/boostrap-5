@include('layouts.partials.header')
    <div class="loader justify-content-center ">
        <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="wrapper">

@include('layouts.app-master')


        <!-- page main start -->
        <div class="page">
            
        <!--include('layouts.partials.navbar-direito')-->

    <div class="page-content">
                <!-- page content goes here -->
        <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('auth.painel.ranking.show')
                </div>
                <div class="tab-pane fade show active" id="desafios" role="tabpanel" aria-labelledby="desafios-tab">
                @if(auth()->user()->permissao == 1)
                    @include('auth.painel.admin.show')
                @else
                    @include('auth.painel.perguntas.show')
                @endif
                </div>
                <div class="tab-pane fade" id="recurring" role="tabpanel" aria-labelledby="recurring-tab">
                    
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    @include('auth.painel.perfil.show')
                    
                </div>
                </div>
            </div>     

        </div>
<!-- page main ends -->
</div>
@include('layouts.partials.footer-sticky')
@include('layouts.partials.footer')

</body>
</html>