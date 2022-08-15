    
    
    
    <script src="{!! asset('assets/ectecnologia/js/jquery-3.2.1.min.js') !!}"></script>
    <script src="{!! asset('assets/ectecnologia/js/popper.min.js') !!}"></script>
    <script src="{!! asset('assets/ectecnologia/vendor/bootstrap-4.3.1/js/bootstrap.min.js') !!}"></script>
    
    <!-- Propeller Global js --> 
    <script src="https://opensource.propeller.in/components/global/js/global.js"></script>

    <!-- Propeller radio js -->
    <script type="text/javascript" src="https://opensource.propeller.in/components/radio/js/radio.js"></script>

    <!-- Propeller checkbox js -->
    <script type="text/javascript" src="https://opensource.propeller.in/components/checkbox/js/checkbox.js"></script>


    <!-- Propeller checkbox js -->
    <script type="text/javascript" src="{!! asset('assets/propellerkit/components/alert/js/alert.js') !!}"></script>

    <!-- Cookie jquery file 
    <script src="{!! asset('assets/ectecnologia/vendor/cookie/jquery.cookie.js') !!}"></script>-->
    
    <!-- sparklines chart jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/sparklines/jquery.sparkline.min.js') !!}"></script>
    
    <!-- Circular progress gauge jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/circle-progress/circle-progress.min.js') !!}"></script>
    
    <!-- Swiper carousel jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/swiper/js/swiper.min.js') !!}"></script>
    <script src="{!! asset('assets/ectecnologia/vendor/sweetalert/sweetalert.min.js') !!}"></script>
    <!-- Application main common jquery file -->
    <script src="{!! asset('assets/ectecnologia/js/main.js') !!}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>


    <!-- Propeller  js -->
    <script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

    <!-- Propeller  js -->
    <script type="text/javascript" src="{!! asset('assets/propellerkit/components/file-upload/js/upload-image.js') !!}"></script>

    <!-- Propeller  js -->
    <script type="text/javascript" src="{!! asset('assets/propellerkit/components/card/js/jquery.masonry.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/magnific/jquery.magnific-popup.min.js') !!}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.min.js"></script>

    <!-- PWA 
    <script src="{!! asset('assets/app/scripts/luxon-1.11.4.js') !!}"></script>
     <-- <script src="{!! asset('assets/app/scripts/app.js') !!}"></script> --
    <-- CODELAB: Add the install script here --
    <script src="{!! asset('assets/app/scripts/install.js') !!}"></script>-->

    <!-- Select2 js-->
    <script type="text/javascript" src="http://propeller.in/components/select2/js/select2.full.js"></script>

    <!-- Propeller Select2 -->
    <script type="text/javascript">
        $(document).ready(function() {
            
            $(".select-tags").select2({
                tags: false,
                theme: "bootstrap",
            })
        });
    </script>

    <!-- Propeller Select2 -->
    <script type="text/javascript" src="http://propeller.in/components/select2/js/pmd-select2.js"></script>

    <script>
        $(document).ready(function(){
            $('.telefone').inputmask('99999999999');
            $('.cpf').inputmask('99999999999');
        });

        $('.parent-container').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                enabled:true
                }
            });
        });
    </script>

    <!-- page specific script -->
    <script>


        $(window).on('load', function() {
            /* sparklines */
            $(".dynamicsparkline").sparkline([5, 6, 7, 2, 0, 4, 2, 5, 6, 7, 2, 0, 4, 2, 4], {
                type: 'bar',
                height: '25',
                barSpacing: 2,
                barColor: '#a9d7fe',
                negBarColor: '#ef4055',
                zeroColor: '#ffffff'
            });

            /* gauge chart circular progress */
            $('.progress_profile1').circleProgress({
                fill: '#169cf1',
                lineCap: 'butt'
            });
            $('.progress_profile2').circleProgress({
                fill: '#f4465e',
                lineCap: 'butt'
            });
            $('.progress_profile4').circleProgress({
                fill: '#ffc000',
                lineCap: 'butt'
            });
            $('.progress_profile3').circleProgress({
                fill: '#00c473',
                lineCap: 'butt'
            });

            /*Swiper carousel */
            var mySwiper = new Swiper('.swiper-container', {
                slidesPerView: 2,
                spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                }
            });
        });

</script>

<!--<script>

const server = "http://pg.local";

//Vue.component(swal)

new Vue({
    el: '#root',
    data: {
        users: [],
        formData: {}
    },
    async created() {

        let results = await axios.get(`${server}/users`);

        this.users = results.data;

    },
    methods: {
        async addUser(data) {
                    if (!data.name) {
                        
                        alert('Informe o nome');

                    } else if (!data.email) {
                        
                        alert('Informe o email');

                    } else {
                        
                            let results = await axios.post(`${server}/users`, data)
                            .catch(function (error) {
                                if (error.response) {
                                // A requisição foi feita e o servidor respondeu com um código de status
                                // que sai do alcance de 2xx
                                    //console.error(error.response.data.errors);

                                    //console.log(JSON.parse(error.response.data.errors.email));

                                    var teste = [''+ error.response.data.errors.email +'',''+ error.response.data.errors.numero_telefone +''];
                                    var dados = "";

                                    console.log(teste);

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
                        });

                        this.users.push({
                            id: results.data.id,
                            name: results.data.name,
                            email: results.data.email,
                            numero_telefone: results.data.numero_telefone,
                            igreja_classe_id: results.data.igreja_classe_id
                        });
                        

                        $('#form-dialog').modal('hide');
                    }
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

</script>-->