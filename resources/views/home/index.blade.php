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
                    @include('auth.painel.ranking.show')-->
                </div>
                <div class="tab-pane active" id="desafios" role="tabpanel" aria-labelledby="desafios-tab">
                @if(auth()->user()->permissao == 1 || auth()->user()->permissao == 2)
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
				<!--<form v-on:submit.prevent="addUser(formData)">-->
				<!--<form method="post" action="{{ route('create.perform') }}" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Nome</label>
						<input type="text" class="mat-input form-control" id="name" name="name" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">CPF</label>
						<input type="text" class="mat-input form-control" id="cpf" name="cpf" maxlength="11" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">ES OU PG</label>
						<select class="mat-input form-control" name="igreja_classe_id" required>
							@foreach($dados_classe as $cl)
								@if(auth()->user()->igreja_classe_id == $cl->id)
								<option value="{{ $cl->id }}"> {{ $cl->titulo }} </option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Email</label>
						<input type="text" class="mat-input form-control" id="email" name="email" required>
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Celular</label>
						<input type="text" class="mat-input form-control" id="mobil" name="numero_telefone" required>
					</div>
					--<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label class="control-label">Message</label>
						<textarea required class="form-control"></textarea>
					</div>-
					<label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
						<input type="checkbox" value="" required>
						<span class="pmd-checkbox"> Aceita termos e Condições</span> </label>
				 
					<div class="pmd-modal-action">
						<button class="btn pmd-ripple-effect btn-primary" type="submit">Salvar</button>
						<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Descartar</button>
					</div>-->
					<form v-on:submit.prevent="addUser(formData)">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Nome</label>
						<input type="text" class="mat-input form-control" id="name" v-model="formData.name" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">CPF</label>
						<input type="text" class="mat-input form-control" id="cpf" v-model="formData.cpf" maxlength="11" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">ES OU PG</label>
						<select class="mat-input form-control" name="igreja_classe_id" required>
							@foreach($dados_classe as $cl)
								@if(auth()->user()->igreja_classe_id == $cl->id)
								<option value="{{ $cl->id }}"> {{ $cl->titulo }} </option>
								@endif
							@endforeach
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
					<label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
						<input type="checkbox" value="" required>
						<span class="pmd-checkbox"> Aceita termos e Condições</span> </label>
				 
					<div class="pmd-modal-action">
						<button class="btn pmd-ripple-effect btn-primary" type="submit">Salvar</button>
						<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Descartar</button>
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
					<form v-on:submit.prevent="addUserSupervidor(formData)">
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">Nome</label>
						<input type="text" class="mat-input form-control" id="name" v-model="formData.name" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">CPF</label>
						<input type="text" max="11" class="mat-input form-control" id="cpf" v-model="formData.cpf" required>						
					</div>
					<div class="form-group pmd-textfield pmd-textfield-floating-label">
						<label for="first-name">ES OU PG</label>
						<select class="mat-input form-control" v-model="formData.igreja_classe_id" multiple="multiple" required>
							@foreach($dados_classe as $cl)
								<option value="{{ $cl->id }}"> {{ $cl->titulo }} </option>
							@endforeach
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
					<label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
						<input type="checkbox" value="" required>
						<span class="pmd-checkbox"> Aceita termos e Condições</span> </label>
				 
					<div class="pmd-modal-action">
						<button class="btn pmd-ripple-effect btn-primary" type="submit">Salvar</button>
						<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Descartar</button>
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