<section class="row component-section">
    <div class="col-md-12"> 
        <div class="component-box">
            <div class="row">
                <div class="col-md-12 card-type">
                    <div class="pmd-card pmd-card-default pmd-z-depth">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="pmd-card-icon">
                                <div class="pmd-floating-icon-wrapper">
                                @if(auth()->user()->foto != null)
                                    <img src="{{ asset('assets/img/perfil/'.auth()->user()->cpf.'/'.auth()->user()->cpf.'.jpg') }}" class="rounded-circle" alt="" width="100">
                                @else
                                    <img src="{{ asset('assets/img/logo.jpg') }}" class="rounded-circle" alt="" width="100">
                                @endif
                                <i class="material-icons pmd-icon-circle pmd-floating-icon-br">done</i>
                                </div>
                            </div>
                            <h3 class="card-title">{{auth()->user()->name}}</h3>
                            <p class="card-subtitle mb-2">Lider</p>
                            <p class="card-text">E disse-lhes: Ide por todo o mundo, pregai o evangelho a toda criatura. Marcos 16:15.</p>
                            @if(auth()->user()->permissao == 1)
                                <a data-target="#form-dialog" data-toggle="modal" href="#" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">Incluir Membros</a>
                            @elseif(auth()->user()->permissao == 3)
                                <a data-target="#form-pg" data-toggle="modal" href="#" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">ES/PG</a>
                                <a data-target="#form-dialog2" data-toggle="modal" href="#" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">Lider/Supervisor</a>
                            @endif
                        </div>
                        <div class="pmd-card-actions">
                            <span>
                                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">share</i></button>
                                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">thumb_up</i></button>
                                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">drafts</i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pmd-card pmd-card-default pmd-z-depth pmd-card-custom-form">
                        <h2 class="block-title">{{ $dados_perfil->titulo}} </h2>
                        <ul class="list-group">
                            @if(auth()->user()->permissao == 1)
                            <li class="list-group-item" v-for="user in users" :key="user.id">
                                <a href="#" class="media">
                                    <div class="w-auto h-100">
                                        <figure class="avatar avatar-40"><img src="{{ asset('assets/img/logo.jpg') }}" alt=""> </figure>
                                    </div>
                                    <div class="media-body">
                                        <h5 v-text="user.name"><span class="status-online bg-success"></span></h5>
                                    </div>
                                </a>
                            </li>
                            @elseif(auth()->user()->permissao == 3)                            
                            <li class="list-group-item"  v-for="user in classes" :key="user.id">
                                <form v-on:submit.prevent="geraruri(user)" autocomplete="off" class="media">
                                    <div class="w-auto h-100">
                                        <figure class="avatar avatar-40"><img src="{{ asset('assets/img/logo.jpg') }}" alt=""> </figure>
                                    </div>
                                    <div class="media-body">
                                        <h5 v-text="user.name"><span class="status-online bg-success"></span></h5>
                                    </div>
                                    <input type="hidden" id="id" v-model="user.name" value="user.name"/>
                                    <input type="hidden" id="id" v-model="user.numero_telefone" value="user.numero_telefone"/>
                                    <input type="hidden" id="id" v-model="user.username" value="user.username"/>
                                    <input type="hidden" id="password_temporario" v-model="formData.password_temporario" value="user.password_temporario"/>
                                    <button type="submit" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">DADOS</button>
                                </form>
                            </li>
                            @else
                            <li class="list-group-item" v-for="user in classes" :key="user.id" :value="user.id">
                                <a href="#" class="media">
                                    <div class="w-auto h-100">
                                        <figure class="avatar avatar-40"><img src="{{ asset('assets/img/logo.jpg') }}" alt=""> </figure>
                                    </div>
                                    <div class="media-body">
                                        <h5 v-text="user.name"><span class="status-online bg-success"></span></h5>
                                    </div>
                                    <button @click="generateUrl" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">DADOS</button>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>