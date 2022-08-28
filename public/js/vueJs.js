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


new Vue({
    el: '#app',
    data: {
        users: [],
        classes: [],
        pgs: [],
        igrejas: [],
        formData: {},
        whatsappurl:'',
        resetfild: {}
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
        
        async resetFormFields() {
            this.formData = { ...this.resetfild };
        },
        async addUser(data) {
                        
                let results = await axios.post(`${server}/users`, data)
                .catch(function (error) {
                    if (error.response) {

                        var teste = [
                            ''+ error.response.data.errors.name +'',
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
                        console.error(error.request);
                    } else {
                        console.error('Error', error.message);
                    }
            });

            this.users.push({
                id: results.data.id,
                name: results.data.name,
                numero_telefone: results.data.numero_telefone,
                igreja_classe_id: results.data.igreja_classe_id
            });

            $('#form-dialog').modal('hide');

            this.resetFormFields();
        },
        async addPG(data) {
                        
        let results_pgs = await axios.post(`${server}/users/createpg`, data)
            .catch(function (error) {
                if (error.response) {
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
                    console.error(error.request);
                } else {
                    console.error('Error', error.message);
                }
            });

            this.pgs.push({
                id: results_pgs.data.id,
                titulo: results_pgs.data.titulo,
            });

            this.resetFormFields();
        },
        async addUserSupervidor(data) {
                        
                    let results_supervisor = await axios.post(`${server}/users/supervisor`, data)
                    .catch(function (error) {
                        if (error.response) {

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
                            console.error(error.request);
                        } else {
                            console.error('Error', error.message);
                        }
                    formData.target.reset();

                });

            this.classes.push({
                    id: results_supervisor.data.id,
                    name: results_supervisor.data.name,
                });

            $('#form-dialog2').modal('hide');

            this.resetFormFields();

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
                console.error(err);
            });

            this.users = this.users.filter(user => {
                return (user.id != id);
            })
        },
        async geraruri(data){

            var texto = '*Olá* '+ data.name +'! %0ADados para acesso ao Sistema. %0A%0A*Login:* : '+ data.username +'%0A*Senha* : '+ data.password_temporario +'%0A%0A link: https://adv.quer.app %0A%0A Qualquer duvida nos envie mensagem!';
            window.open("https://api.whatsapp.com/send?phone=55"+ data.numero_telefone +"&text="+ texto.replace(/ /g, "%20") +""); 

        }
     }
})