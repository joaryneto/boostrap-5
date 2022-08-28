@include('layouts.partials.header')
<div class="loader justify-content-center ">
    <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
<div class="wrapper" id="app">
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
                <div class="tab-pane active" id="desafios" role="tabpanel" aria-labelledby="desafios-tab">
                @if(auth()->user()->permissao == 2 || auth()->user()->permissao == 3)
                    @include('auth.painel.admin.show')
                @else
                    @include('auth.painel.perguntas.show')
                @endif
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @include('auth.painel.perfil.show')
                </div>
                <div class="tab-pane" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                    @include('layouts.partials.navmenu')
                </div>
            </div>
        </div>     
    </div>
<!-- Dialog with Form Elements -->
<div tabindex="-1" class="modal fade" id="form-dialog" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content"  id="root">
			<div class="modal-header pmd-modal-bordered">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h2 class="pmd-card-title-text">Incluir Membro</h2>
			</div>					
			<div class="modal-body">
					<form v-on:submit.prevent="addUser(formData)" autocomplete="off">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Nome</label>
						<input type="text" class="mat-input form-control" id="name" v-model="formData.name" required>						
					</div>
					<!--<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">CPF</label>
						<input type="text" class="mat-input form-control" id="cpf" v-model="formData.cpf" maxlength="11" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label" style="display:none">
						<label for="first-name">ES OU PG</label>
						<select class="mat-input form-control" name="igreja_classe_id" required>
							@foreach($dados_classe as $cl)
								@if(auth()->user()->igreja_classe_id == $cl->id)
								<option value="{{ $cl->id }}"> {{ $cl->titulo }} </option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label" style="display:none">
						<label for="first-name">Email</label>
						<input type="text" class="mat-input form-control" id="email" v-model="formData.email">
					</div>-->
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Celular</label>
						<input type="text" class="mat-input form-control" id="mobil" v-model="formData.numero_telefone" required>
					</div>
					<!--<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label class="control-label">Message</label>
						<textarea required class="form-control"></textarea>
					</div>-->
					<!--<label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
						<input type="checkbox" value="" required>
						<span class="pmd-checkbox"> Aceita termos e Condições</span> </label>
					-->
					<div class="pmd-modal-action">
						<button class="btn pmd-ripple-effect btn-primary" type="submit">Salvar</button>
						<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Fechar</button>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
<!-- Dialog with Form Elements -->
<div tabindex="-1" class="modal fade" id="form-dialog2" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pmd-modal-bordered">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h2 class="pmd-card-title-text">Incluir Lider/Supervidor</h2>
			</div>					
			<div class="modal-body">
				<!--<form v-on:submit.prevent="addUser(formData)">-->
					<form v-on:submit.prevent="addUserSupervidor(formData)" autocomplete="off">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Nome</label>
						<input type="text" class="mat-input form-control" id="name" onkeyup="gerar()" v-model="formData.name" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">CPF</label>
						<input type="text" max="11" class="mat-input form-control" id="cpf" v-model="formData.cpf" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">ES OU PG</label>
						<select class="mat-input form-control" v-model="formData.igreja_classe_id" multiple="multiple" required>
								<option v-for="user in pgs" :value="user.id" v-text="user.titulo"></option>
						</select>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Email</label>
						<input type="text" class="mat-input form-control" id="email" v-model="formData.email" required>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Celular</label>
						<input type="text" class="mat-input form-control" id="mobil" v-model="formData.numero_telefone" required>
					</div>
					<!--<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label class="control-label">Message</label>
						<textarea required class="form-control"></textarea>
					</div>-->
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Tipo</label>
						<select class="mat-input form-control" v-model="formData.permissao" required>
								<option value="1"> Lider </option>
								<option value="2"> Supervisor </option>
								<option value="3"> Pastor </option>
						</select>
					</div>
					<label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
						<input type="checkbox" value="" required>
						<span class="pmd-checkbox"> Aceita termos e Condições</span> </label>
				 
					<div class="pmd-modal-action">
						<button class="btn pmd-ripple-effect btn-primary" type="submit">Salvar</button>
						<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Fechar</button>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
<!-- Dialog with Form Elements -->
<div tabindex="-1" class="modal fade" id="form-pg" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pmd-modal-bordered">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h2 class="pmd-card-title-text">Incluir Classe e PG</h2>
			</div>					
			<div class="modal-body">
				<!--<form v-on:submit.prevent="addUser(formData)">-->
					<form v-on:submit.prevent="addPG(formData)" autocomplete="off">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Nome do PG/ES</label>
						<input type="text" class="mat-input form-control" id="titulo" v-model="formData.titulo" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">IGREJA</label>
						<select class="mat-input form-control" v-model="formData.igreja_id" required>
								<option v-for="user in igrejas" :value="user.id" v-text="user.titulo">

								</option>
						</select>
					</div>
					<button class="btn pmd-ripple-effect btn-primary" type="submit">Salvar</button>
					<br><br>
					<ul class="list-group">
						<li class="list-group-item" v-for="user in pgs" :key="user.id">
							<a href="#" class="media">
								<div class="w-auto h-100">
									<figure class="avatar avatar-40"><img src="{{ asset('assets/img/logo.jpg') }}" alt=""> </figure>
								</div>
								<div class="media-body">
									<h5 v-text="user.titulo"><span class="status-online bg-success"></span></h5>
								</div>
							</a>
						</li>
					</ul>
					<br><br>
					<div class="pmd-modal-action">
						<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Fechar</button>
					</div>
				</form>
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