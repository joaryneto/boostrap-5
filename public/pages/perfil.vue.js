var Perfil = { 
	breakpoints: {
    mobile: 450,
    tablet: 900,
    laptop: 1250,
    desktop: Infinity,
  	},
	template: `<section class="row component-section">
    <div class="col-md-12"> 
        <div class="component-box">
            <div class="row">
                <div class="col-md-12 card-type">
                    <div class="pmd-card pmd-card-default pmd-z-depth">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="pmd-card-icon">
                                <div class="pmd-floating-icon-wrapper">
                                <img src="assets/img/logo.jpg" class="rounded-circle" alt="" width="100">
                                <i class="material-icons pmd-icon-circle pmd-floating-icon-br">done</i>
                                </div>
                            </div>
                            <h3 class="card-title"> {{ autenticado.name }} {{ autenticado.permissao }}</h3>
                            <p class="card-subtitle mb-2">Lider</p>
                            <p class="card-text">E disse-lhes: Ide por todo o mundo, pregai o evangelho a toda criatura. Marcos 16:15.</p>
                                <a v-if="autenticado.permissao==1" data-target="#form-dialog" data-toggle="modal" href="#" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">Incluir Membros</a>
                                <a v-if="autenticado.permissao==3" data-target="#form-pg" data-toggle="modal" href="#" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">ES/PG</a>
                                <a v-if="autenticado.permissao==3" data-target="#form-dialog2" data-toggle="modal" href="#" class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">Lider/Supervisor</a>
                            
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
                        <h2 class="block-title"></h2>
                        <ul class="list-group">
                            <li v-if="autenticado.permissao==1" class="list-group-item" v-for="user in users" :key="user.id">
                                <a href="#" class="media">
                                    <div class="w-auto h-100">
                                        <figure class="avatar avatar-40"><img src="assets/img/logo.jpg" alt=""> </figure>
                                    </div>
                                    <div class="media-body">
                                        <h5>{{ user.name }}<span class="status-online bg-success"></span></h5>
                                    </div>
                                </a>
                            </li>
                            <li v-if="autenticado.permissao==3" class="list-group-item" v-for="user in classes" :key="user.id">
                                <form v-on:submit.prevent="addPG(formData)" autocomplete="off">
							    <a href="#" class="media">
                                    <div class="w-auto h-100">
                                        <figure class="avatar avatar-40"><img src="assets/img/logo.jpg" alt=""> </figure>
                                    </div>
                                    <div class="media-body">
                                        <h5>{{ user.name }}<span class="status-online bg-success"></span></h5>
                                    </div>
                                    <input type="hidden" id="id" v-model="formData.username" value="{{ user.id }} "/>
                                    <input type="hidden" id="password_temporario" v-model="formData.password_temporario" value=" {{ user.password_temporario }}"/>
                                    <button class="btn pmd-ripple-effect btn-primary pmd-btn-raised btn-sm">DADOS</button>
                                </a>
								</form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</section>`,
	data() {
        return {
			users: [],
			classes: [],
			pgs: [],
			autenticado: [],
			igrejas: [],
			formData: {},
		};
    },
	/*async mounted () {
		axios
		  .get(`${server}/users`)
		  .then(response => (this.users = response))
	},*/
	async created() {

        let results = await axios.get(`${server}/users`)
        .then((res) => {

            this.users = res.data;

        }).catch(function (error) {
    
            if (error.status === 409) {
                
            } 
            else if(error.request.status == 401){
                    window.location.href = "/login2";
            }else {
                console.log(error.request.status)
            }
    
        });


		let results_autenticado = await axios.get(`${server}/users/autenticado`);
        this.autenticado = results_autenticado.data;

        let results_supervisor = await axios.get(`${server}/users/supervisor`);
        this.classes = results_supervisor.data;

        let results_pgs = await axios.get(`${server}/users/pg`);
        this.pgs = results_pgs.data;

        let results_igrejas = await axios.get(`${server}/api/igrejas`);
        this.igrejas = results_igrejas.data;
    },
	methods: {
		async AdicionarPG(data) {
							
			let results_pgs = await axios.post(`${server}/users/createpg`, data)
				.catch(function (error) {
					if (error.response) {
						var teste = [
							''+ error.response.data.errors.titulo +''
						];

						var dados = '';

						for (i = 0; i < teste.length; i++){
							if(teste[i] != 'undefined'){
								dados = teste[i];
							}
						}
						Swal.fire(''+ dados +'');
					} 
				});

				this.pgs.push({
					id: results_pgs.data.id,
					titulo: results_pgs.data.titulo,
				});

				//$('#form-pg').modal('hide');
			},

		/*async beforeRouteUpdate(to, from) {
			// react to route changes...
			this.userData = await fetchUser(to.params.id)
		},*/
		
    },
	
};