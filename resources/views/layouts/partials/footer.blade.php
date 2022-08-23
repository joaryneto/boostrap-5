    
    
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.min.js"></script>

    
    <script src="{!! asset('assets/ectecnologia/js/jquery-3.2.1.min.js') !!}"></script>
    <script src="{!! asset('assets/ectecnologia/js/popper.min.js') !!}"></script>
    <script src="{!! asset('assets/ectecnologia/vendor/bootstrap-4.3.1/js/bootstrap.min.js') !!}"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap-4.3.1/js/bootstrap.min.js"></script>-->
    
    <!-- Sweet-Alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.min.js"></script>


    <!-- Propeller Global js --> 
    <script src="https://opensource.propeller.in/components/global/js/global.js"></script>

    <!-- Propeller radio js -->
    <script type="text/javascript" src="https://opensource.propeller.in/components/radio/js/radio.js"></script>

    <!-- Propeller checkbox js -->
    <script type="text/javascript" src="https://opensource.propeller.in/components/checkbox/js/checkbox.js"></script>

    <!-- Cookie jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/cookie/jquery.cookie.js') !!}"></script>

    <!-- Application main common jquery file 
    <script src="{!! asset('assets/ectecnologia/js/main.js') !!}"></script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>


    <!-- Propeller  js -->
    <script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>


    <!-- Propeller  js -->
    <script type="text/javascript" src="{!! asset('assets/propellerkit/components/card/js/jquery.masonry.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/magnific/jquery.magnific-popup.min.js') !!}"></script>


    <!--
     PWA 
    <script src="{!! asset('assets/app/scripts/luxon-1.11.4.js') !!}"></script>
     <-- <script src="{!! asset('assets/app/scripts/app.js') !!}"></script> --
    <-- CODELAB: Add the install script here --
    <script src="{!! asset('assets/app/scripts/install.js') !!}"></script>-->

    <script>
        $(document).ready(function(){
            $('.telefone').inputmask('99999999999');
            $('.cpf').inputmask('99999999999');
        });

        $(document).ready(function() {

            $('.parent-container').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                    enabled:true
                    }
                });
            });
        });

    </script>

<script>

const server = "{{ env('ASSET_URL') }}";

//Vue.component(swal)

new Vue({
    el: '#app',
    data: {
        users: [],
        classes: [],
        pgs: [],
        igrejas: [],
        formData: {}
    },
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
        
        async addUser(data) {
                        
                let results = await axios.post(`${server}/users`, data)
                .catch(function (error) {
                    if (error.response) {
                    // A requisição foi feita e o servidor respondeu com um código de status
                    // que sai do alcance de 2xx
                        //console.error(error.response.data.errors);

                        //console.log(JSON.parse(error.response.data.errors.email));

                        var teste = [
                            ''+ error.response.data.errors.email +'',
                            ''+ error.response.data.errors.cpf +'',
                            ''+ error.response.data.errors.numero_telefone +'',
                            ''+ error.response.data.errors.count + '',
                        ];
                        var dados = "";

                        for (i = 0; i < teste.length; i++){
                            if(teste[i] != 'undefined'){
                                dados = teste[i];
                            }
                        }

                        Swal.fire(''+ dados +'');


                    } else if (error.request) {
                    // A requisição foi feita mas nenhuma resposta foi recebida
                    // `error.request` é uma instância do XMLHttpRequest no navegador e uma instância de
                    // http.ClientRequest no node.js
                        console.error(error.request);
                    } else {
                    // Alguma coisa acontenceu ao configurar a requisição que acionou este erro.
                        console.error('Error', error.message);
                    }
                //console.error(error.config);
            });

            this.users.push({
                id: results.data.id,
                name: results.data.name,
                email: results.data.email,
                numero_telefone: results.data.numero_telefone,
                igreja_classe_id: results.data.igreja_classe_id
            });
            

            $('#form-dialog').modal('hide');
        },
        async addPG(data) {
                        
        let results_pgs = await axios.post(`${server}/users/createpg`, data)
            .catch(function (error) {
                if (error.response) {
                // A requisição foi feita e o servidor respondeu com um código de status
                // que sai do alcance de 2xx
                    //console.error(error.response.data.errors);

                    //console.log(JSON.parse(error.response.data.errors.email));

                    var teste = [
                        ''+ error.response.data.errors.titulo +''
                    ];

                    var dados = "";

                    for (i = 0; i < teste.length; i++){
                        if(teste[i] != 'undefined'){
                            dados = teste[i];
                        }
                    }

                    Swal.fire(''+ dados +'');


                } else if (error.request) {
                // A requisição foi feita mas nenhuma resposta foi recebida
                // `error.request` é uma instância do XMLHttpRequest no navegador e uma instância de
                // http.ClientRequest no node.js
                    console.error(error.request);
                } else {
                // Alguma coisa acontenceu ao configurar a requisição que acionou este erro.
                    console.error('Error', error.message);
                }
            //console.error(error.config);
            });

            this.pgs.push({
                id: results_pgs.data.id,
                titulo: results_pgs.data.titulo,
            });

            //$('#form-pg').modal('hide');
        },
        async addUserSupervidor(data) {
                        
                    let results_supervisor = await axios.post(`${server}/users/supervisor`, data)
                    .catch(function (error) {
                        if (error.response) {
                        // A requisição foi feita e o servidor respondeu com um código de status
                        // que sai do alcance de 2xx
                            //console.error(error.response.data.errors);

                            var teste = [
                                ''+ error.response.data.errors.email +'',
                                ''+ error.response.data.errors.cpf +'',
                                ''+ error.response.data.errors.numero_telefone +'',
                            ];
                            var dados = "";

                            for (i = 0; i < teste.length; i++){
                                if(teste[i] != 'undefined'){
                                    dados = teste[i];
                                }
                            }

                            swal({   
                                    title: "Atenção!",   
                                    text: ''+ dados +'',   
                                    timer: 2000,   
                                    icon: "error",
                                    showConfirmButton: false ,
                            });


                        } else if (error.request) {
                        // A requisição foi feita mas nenhuma resposta foi recebida
                        // `error.request` é uma instância do XMLHttpRequest no navegador e uma instância de
                        // http.ClientRequest no node.js
                            console.error(error.request);
                        } else {
                        // Alguma coisa acontenceu ao configurar a requisição que acionou este erro.
                            console.error('Error', error.message);
                        }
                    //console.error(error.config);

                    formData.target.reset();

                });

            this.classes.push({
                    id: results_supervisor.data.id,
                    name: results_supervisor.data.name,
                });
            

            $('#form-dialog2').modal('hide');

        },
        async setUser(data) {

            if (!data.name) {
                alert('Informe o nome');
            } else if (!data.email) {
                alert('Informe o email');
            } else {
                
                await axios.patch(`${server}/users/${data.id}`, data);
                
            }

        },
        async removeUser(id) {

            await axios.delete(`${server}/users/${id}`)
            .then(resp => {
                console.log(resp.data);
            })
            .catch(err => {
                // Handle Error Here
                console.error(err);
            });

            this.users = this.users.filter(user => {
                return (user.id != id);
            })
        }
     }
})

</script>