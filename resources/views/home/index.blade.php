@include('layouts.partials.header')
    <div class="loader justify-content-center ">
        <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="wrapper">

@include('layouts.app-master')


        <!-- page main start -->
        <div class="page">
            
        @include('layouts.partials.navbar-direito')

            <div class="page-content">
                <div class="content-sticky-footer">
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
                                            <h4 class="title-small-carousel">Completado</h4>
                                            <p>Julho 2022</p>
                                            <div class="gaugewrap">
                                                <h2 class="title-number-carousel"><span class="text-primary">1</span><small>/1 Gincana SuperAção</small></h2>
                                                <div class="progress_profile1 gauge" data-value="0.65" data-size="100" data-thickness="2" data-animation-start-value="0" data-reverse="false"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="swiper-slide">
                                        <div class="swiper-content-block ">
                                            <h4 class="title-small-carousel">Overrun Project</h4>
                                            <p>November 2018</p>
                                            <div class="gaugewrap">
                                                <h2 class="title-number-carousel"><span class="text-danger">2</span><small>/3 Project</small></h2>
                                                <div class="progress_profile2  gauge" data-value="0.65" data-size="20" data-thickness="2" data-animation-start-value="0" data-reverse="false"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-content-block ">
                                            <h4 class="title-small-carousel">Good Job!</h4>
                                            <p>November 2018</p>
                                            <div class="gaugewrap">
                                                <h2 class="title-number-carousel"><span class="text-success">6</span><small>/8 Project</small></h2>
                                                <div class="progress_profile3  gauge" data-value="0.65" data-size="20" data-thickness="2" data-animation-start-value="0" data-reverse="false"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-content-block ">
                                            <h4 class="title-small-carousel">Critical Project</h4>
                                            <p>November 2018</p>
                                            <div class="gaugewrap">
                                                <h2 class="title-number-carousel"><span class="text-warning">2</span><small>/3 Project</small></h2>
                                                <div class="progress_profile4  gauge" data-value="0.65" data-size="20" data-thickness="2" data-animation-start-value="0" data-reverse="false"></div>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--
                    <h2 class="block-title">Top On Going Projects</h2>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="#" class="media">
                                <div class="media-body">
                                    <h5>Alpha School portal</h5>
                                    <p>Start Date: 28, July 2018</p>
                                    <h2 class="title-number-carousel color-primary"><span class="text-primary">126</span><small>/208 Project</small></h2>
                                </div>
                                <div class="w-auto">
                                    <small class="text-danger effort-time"> 2hrs  <i class="material-icons">arrow_drop_down</i></small>
                                    <div class="dynamicsparkline"></div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="media">
                                <div class="media-body">
                                    <h5>RozR David</h5>
                                    <p>Start Date: 28, July 2018</p>
                                    <h2 class="title-number-carousel color-primary"><span class="text-primary">150</span><small>/218 Project</small></h2>
                                </div>
                                <div class="w-auto">
                                    <small class="text-danger effort-time"> 2hrs  <i class="material-icons">arrow_drop_down</i></small>
                                    <div class="dynamicsparkline"></div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="media">
                                <div class="media-body">
                                    <h5>Plasma Research group</h5>
                                    <p>Start Date: 28, July 2018</p>
                                    <h2 class="title-number-carousel color-primary"><span class="text-primary">100</span><small>/152 Project</small></h2>
                                </div>
                                <div class="w-auto">
                                    <small class="text-success effort-time"> 2hrs  <i class="material-icons">arrow_drop_up</i></small>
                                    <div class="dynamicsparkline"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    -->
                    <!--
                    <h2 class="block-title">Latest Comments</h2>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="#" class="media">
                                <div class="w-auto h-100">
                                    <figure class="avatar avatar-40"><img src="img/user1.png" alt=""> </figure>
                                </div>
                                <div class="media-body">
                                    <h5>John Doe <span class="status-online bg-success"></span></h5>
                                    <p>My view is to create greate things </p>
                                </div>

                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="media">
                                <div class="w-auto h-100">
                                    <figure class="avatar avatar-40"><img src="img/user2.png" alt=""> </figure>
                                </div>
                                <div class="media-body">
                                    <h5>Angeliina Hardy <span class="status-online bg-warning"></span></h5>
                                    <p>My view is to create greate things </p>
                                </div>

                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="media">
                                <div class="w-auto h-100">
                                    <figure class="avatar avatar-40"><img src="img/user3.png" alt=""> </figure>
                                </div>
                                <div class="media-body">
                                    <h5>Arnold Johnsons <span class="status-online bg-danger"></span></h5>
                                    <p>My view is to create greate things </p>
                                </div>

                            </a>
                        </li>
                    </ul>

                    <h2 class="block-title">Trending Project</h2>
                    <div class="row mx-0">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" class="media">
                                        <div class="media-body">
                                            <h5>Karla Sports App </h5>
                                            <p>25 November 2018</p>
                                        </div>
                                        <div class="w-auto h-100">
                                            <span class="text-primary">Completed</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <i class="material-icons text-warning">star</i>
                                            <span class="post-seconds">4.9 <span>(254)</span></span>
                                        </div>
                                        <div class="col">
                                            <i class="material-icons text-grey">schedule</i>
                                            <span class="post-seconds">254 <span>hrs</span></span>
                                        </div>
                                        <div class="col">
                                            <i class="material-icons text-grey">monetization_on</i>
                                            <span class="post-seconds">4000 <span>$</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="block-title text-center">About us</div>
                    <h2 class="text-center mt-0 mb-4">We are MobileUX</h2>
                    <div class="row mx-0">
                        <div class="col">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
                                <br>
                                <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                        <div class="col col-sm-2">
                            <figure class="m-0">
                                <img src="img/background.png" class="mw-100" alt="">
                            </figure>
                        </div>
                    </div>
                    <br>
                </div>-->
                <div class="footer-wrapper">
                    <div class="footer">
                        <div class="row mx-0">
                            <div class="col">
                                MobileUI
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
                            <div class="col  text-center">
                                @2022, EC TECNOLOGIA
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- page main ends -->

</div>
@include('layouts.partials.footer')

</body>
</html>