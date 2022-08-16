@include('layouts.partials.header')

<div class="loader justify-content-center ">
        <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="wrapper">

    <!-- page main start -->
    <div class="page">
            <div class="page-content h-100">
                <div class="background"><img src="https://c4.wallpaperflare.com/wallpaper/680/446/542/full-hd-1080p-nature-desktop-backgrounds-hd-1920x1200-wallpaper-preview.jpg" alt=""></div>
                <div class="row mx-0 text-center ">
                    <div class="col">
                        <img src="https://seeklogo.com/images/I/igreja-adventista-do-setimo-dia-circular-logo-35819A51FB-seeklogo.com.png" alt="" class="login-logo">
                        <h1 class="login-title"><small>Bem-vindo!</small><br></h1>
                    </div>
                    @include('layouts.partials.messages')
                </div>
                <div class="row mx-0">
                    <div class="col">
                        <ul class="nav nav-tabs login-tabs mt-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link border-white text-white active show" data-toggle="tab" href="#signin" role="tab" aria-selected="true">Login</a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link border-white text-white" data-toggle="tab" href="#signup" role="tab" aria-selected="false">Registrar</a>
                            </li>-->
                        </ul>
                        <!-- tabs content start here -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="signin" role="tabpanel">
                                <form autocomplete="false" method="post" action="{{ route('login.perform') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="login-input-content">
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">person</i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Usuario" name="username" value="{{ old('username') }}" autocomplete="off" required="required" autofocus>
                                            @if ($errors->has('username'))
                                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">lock</i></span>
                                            </div>
                                            <input type="text" class="form-control" id="password" placeholder="Senha" name="password" value="{{ old('password') }}" autocomplete="off" required="required">
                                            @if ($errors->has('password'))
                                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mx-0 justify-content-end no-gutters">
                                        <div class="col-6">
                                            <button class="btn btn-block gradient border-0 z-3" id="btninstall" type="submit">Logar</button>
                                        </div>
                                    </div>
                                    <!--<a href="" class="btn btn-link text-white btn-block text-center mt-3">Recuperar Senha?</a>-->
                                </form>
                            </div>
                            <!--<div class="tab-pane" id="signup" role="tabpanel">
                                <form method="post" action="{{ route('register.perform') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="login-input-content">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">person</i></span>
                                            </div>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome completo" required="required" autofocus>
                                            @if ($errors->has('name'))
                                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">CPF</i></span>
                                            </div>
                                            <input type="numeric" class="form-control cpf" name="cpf" value="{{ old('cpf') }}" placeholder="CPF" required="required" autofocus>
                                            @if ($errors->has('cpf'))
                                                <span class="text-danger text-left">{{ $errors->first('cpf') }}</span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">email</i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required="required" autofocus>
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">phone</i></span>
                                            </div>
                                            <input type="tel" class="form-control telefone" placeholder="(00) 00000-0000" name="numero_telefone" placeholder="(00) 00000-0000" aria-label="Username" required="required" autofocus>
                                            @if ($errors->has('numero_telefone'))
                                                <span class="text-danger text-left">{{ $errors->first('numero_telefone') }}</span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">lock</i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Senha" aria-label="Username" name="password" required="required" autofocus>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">lock</i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Confirmar Senha" aria-label="Username" name="password_confirmation" required="required" autofocus>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mx-0 justify-content-end no-gutters">
                                        <div class="col-6">
                                            <button class="btn btn-block gradient border-0 z-3">Registrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>-->
                        </div>
                        <!-- tabs content end here -->
                    </div>
                </div>
              
                <br>

            </div>
        </div>
        <!-- page main ends -->

@include('layouts.partials.footer')

</body>
</html>