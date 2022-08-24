var Desafios = { 
	/*render() {
		return <div></div>
	},*/
	/*data() {

		return { checked: false, title: 'Check me' }
	},*/
	template: `<div>
	<h1>About</h1><p>This is desafios page {{ $route.params.id }}</p>
	<form v-on:submit.prevent="addPG(formData)" autocomplete="off">
	<div class="form-group pmd-textfield pmd-textfield-floating-label">
		<label for="first-name">Nome do PG/ES</label>
		<input type="text" class="mat-input form-control" id="titulo" required>				
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label">
		<label for="first-name">IGREJA</label>
		
	</div>"
	<button class="btn pmd-ripple-effect btn-primary" type="submit">Salvar</button>
	<br><br>
	<ul class="list-group">
		<li class="list-group-item" v-for="user in pgs" :key="user.id">
			<a href="#" class="media">
				<div class="w-auto h-100">
					<figure class="avatar avatar-40"><img src="assets/img/logo.jpg" alt=""> </figure>
				</div>
				<div class="media-body">
					<h5><span class="status-online bg-success"></span></h5>
				</div>
			</a>
		</li>
	</ul>
	<br><br>
	<div class="pmd-modal-action">
		<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">Fechar</button>
	</div>
	</form>
	</div>`,
	data() {
        return {
			users: null
		};
    },
	/*async mounted () {
		axios
		  .get(`${server}/users`)
		  .then(response => (this.users = response))
	},*/
	async created() {

        let results = await axios.get(`${server}/users`);
        this.users = results.data;

        let results_supervisor = await axios.get(`${server}/users/supervisor`);
        this.classes = results_supervisor.data;

        let results_pgs = await axios.get(`${server}/users/pg`);
        this.pgs = results_pgs.data;

        let results_igrejas = await axios.get(`${server}/api/igrejas`);
        this.igrejas = results_igrejas.data;
    },
	methods: {
		async addPG(data) {
							
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