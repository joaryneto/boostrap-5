<!--<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
        <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 text-white">About</a></li>
      </ul>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
      </form>

      @auth
        {{auth()->user()->name}}
        <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
        </div>
      @endguest
    </div>
  </div>
</header>-->

        <!-- sidebar left start -->
        @auth
        <div class="sidebar sidebar-left">
            <div class="profile-link">
                <a href="#" class="media">
                    <div class="w-auto h-100">
                        <figure class="avatar avatar-40"><img src="https://seeklogo.com/images/I/igreja-adventista-do-setimo-dia-circular-logo-35819A51FB-seeklogo.com.png" alt=""> </figure>
                    </div>
                    <div class="media-body">
                        <h5> {{auth()->user()->name}}<span class="status-online bg-success"></span></h5>
                        <p>.</p>
                    </div>
                </a>
            </div>
            <nav class="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('home.index') }}" class="sidebar-close">
                            <div class="item-title">
                                <i class="material-icons">home</i> Inicio
                            </div>
                        </a>
                    </li>
                    @if(auth()->user()->permissao == 2){
                    <li class="nav-item">
                        <a href="{{ route('perguntas.showAdm') }}" class="sidebar-close">
                            <div class="item-title">
                                <i class="material-icons">poll</i> Supervionar Atividades
                            </div>
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('perguntas.show') }}" class="sidebar-close">
                            <div class="item-title">
                                <i class="material-icons">poll</i> Atividades
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <div class="profile-link text-center">
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-white btn-block px-3">Sair</a>
            </div>
        </div>
        <!-- sidebar left ends -->

        <!-- sidebar right start -->
        <div class="sidebar sidebar-right">
            <header class="row m-0 fixed-header">
                <div class="left">
                    <a href="javascript:void(0)" class="menu-left-close"><i class="material-icons">keyboard_backspace</i></a>
                </div>
                <div class="col center">
                    <a href="" class="logo">Best Rated</a>
                </div>
            </header>
            <div class="page-content text-white">
                <div class="row mx-0 mt-3">
                    <div class="col">
                        <div class="card bg-none border-0 shadow-none">
                            <div class="card-body userlist_large">
                                <div class="media">
                                    <figure class="avatar avatar-120 rounded-circle my-2">
                                        <img src="img/user1.png" alt="user image">
                                    </figure>
                                    <div class="media-body">
                                        <h4 class="mt-0 text-white">Max Johnsons</h4>
                                        <p class="text-white">VP, Maxartkiller Co. Ltd., India</p>
                                        <h5 class="text-warning my-2">
											<i class="material-icons">star</i>
											<i class="material-icons">star</i>
											<i class="material-icons">star</i>
											<i class="material-icons">star</i>
											
										</h5>
                                        <div class="mb-0">MobileUX is HTML template based on Bootstrap 4.1 framework. This html template can be used in various business domains like Manufacturing, inventory, IT, administration etc.</div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar right ends -->

        <!-- fullscreen menu start -->

        <div class="modal fade popup-fullmenu" id="fullscreenmenu" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content fullscreen-menu">
                    <div class="modal-header">
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a href="/profile/" class="block user-fullmenu popup-close">
                            <figure>
                                <img src="img/user1.png" alt="">
                            </figure>
                            <div class="media-content">
                                <h6>John Doe<br><small>India</small></h6>
                            </div>
                        </a>
                        <br>
                        <div class="row mx-0">
                            <div class="col">
                                <div class="menulist">
                                    <ul>
                                        <li>
                                            <a href="index.html" class="popup-close">
                                                <div class="item-title">
                                                    <i class="icon material-icons md-only">poll</i> Dashboard
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="projects.html" class="popup-close">
                                                <div class="item-title">
                                                    <i class="icon material-icons md-only">add_shopping_cart</i> Projects
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="project-detail.html" class="popup-close">
                                                <div class="item-title">
                                                    <i class="icon material-icons md-only">filter_none</i> Details
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="user-profile.html" class="popup-close">
                                                <div class="item-title">
                                                    <i class="icon material-icons md-only">person</i> Profile
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="aboutus.html" class="popup-close">
                                                <div class="item-title">
                                                    <i class="icon material-icons md-only">domain</i> About
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="component.html" class="popup-close">
                                                <div class="item-title">
                                                    <i class="icon material-icons md-only">pages</i> Component
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mx-0">
                            <div class="col">
                                <a href="login.html" class="rounded btn btn-outline-white text-white popup-close">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
        <!-- fullscreen menu ends -->