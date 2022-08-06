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
                                <a class="nav-link border-white text-white active show" data-toggle="tab" href="#verification" role="tab" aria-selected="true">Login</a>
                            </li>
                        </ul>
                        <!-- tabs content start here -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="verification" role="tabpanel">
                                <form method="post" action="{{ route('verify.perform') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="numero_telefone" value="{{session('numero_telefone')}}">
                                    <div class="login-input-content">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">lock</i></span>
                                            </div>
                                            <input type="verification_code" class="form-control" placeholder="Codigo de verificação" name="verification_code" value="{{ old('verification_code') }}" aria-label="password" required="required">
                                            @if ($errors->has('verification_code'))
                                                <span class="text-danger text-left">{{ $errors->first('verification_code') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @include('auth.partials.copy')
                                    <div class="row mx-0 justify-content-end no-gutters">
                                        <div class="col-6">
                                            <button class="btn btn-block gradient border-0 z-3" type="submit">Confirmar</button>
                                        </div>
                                    </div>
                                    <!--<a href="" class="btn btn-link text-white btn-block text-center mt-3">Recuperar Senha?</a>-->
                                </form>
                            </div>
                        </div>
                        <!-- tabs content end here -->
                    </div>
                </div>
              
                <br>

            </div>
        </div>
        <!-- page main ends -->

@include('layouts.partials.footer')