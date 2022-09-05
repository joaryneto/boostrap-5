var Home = {
	template: `
	<section class="row component-section">
		<div class="col-md-12"> 
			<div class="component-box">
				<h2 class="block-title" style="line-height: initial;font-size: 30px;">Ranking</h2>
				<div class="row">
					<div v-for="(data,key) in ranking" class="col-md-6 col-lg-6">
						<div class="card pmd-card mb-4" style="margin-bottom: 10px;">
							<!-- Card body -->
							<div class="card-body media align-items-center">
								<img alt="profile-pic" src="assets/img/logo2.png" class=" mr-3" style="max-width: 80px;">
								<div class="media-body">
									<h3 class="card-title">{{ key+1 }}° - {{ data.titulo }}</h3>
									<p class="mb-0 card-subtitle"> {{ data.nome_igreja }} </p>
									<p class="mb-0 card-subtitle">
										<strong>{{ data.total }}</strong> Pontos
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>   
		</div>
	</section>
	`,
	data() {
        return {
			ranking: [],
			formData: {},
		};
    },
	async created() {

        let results = await axios.get(`${server}/ranking`)
		.then((res) => {
			//
			this.ranking = res.data;

        }).catch(function (error) {
    
			//console.log(error)

            if (error.status === 409) {
                
            } 
            else if(error.request.status == 401){
                window.location.href = "/login2";
            }else {
               // console.log(error.status)
            }
    
        });

    }
};