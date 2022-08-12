    
    
    
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

    <!-- Cookie jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/cookie/jquery.cookie.js') !!}"></script>
    
    <!-- sparklines chart jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/sparklines/jquery.sparkline.min.js') !!}"></script>
    
    <!-- Circular progress gauge jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/circle-progress/circle-progress.min.js') !!}"></script>
    
    <!-- Swiper carousel jquery file -->
    <script src="{!! asset('assets/ectecnologia/vendor/swiper/js/swiper.min.js') !!}"></script>
    
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


    <!-- PWA -->
    <script src="{!! asset('assets/app/scripts/luxon-1.11.4.js') !!}"></script>
     <!-- <script src="{!! asset('assets/app/scripts/app.js') !!}"></script> -->
    <!-- CODELAB: Add the install script here -->
    <script src="{!! asset('assets/app/scripts/install.js') !!}"></script>

    </script>
	
    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            var swiper = new Swiper('.introduction', {
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        });
        
        var deferredPrompt;

        window.addEventListener('beforeinstallprompt', function(e) {
        console.log('beforeinstallprompt Event fired');
        e.preventDefault();

        // Stash the event so it can be triggered later.
        deferredPrompt = e;

        return false;
        });

        const btnSave = document.getElementById('btninstall');

    btnSave.addEventListener('click', function() {
        if(deferredPrompt !== undefined) {
            // The user has had a postive interaction with our app and Chrome
            // has tried to prompt previously, so let's show the prompt.
            deferredPrompt.prompt();

            // Follow what the user has done with the prompt.
            deferredPrompt.userChoice.then(function(choiceResult) {

            console.log(choiceResult.outcome);

            if(choiceResult.outcome == 'dismissed') {
                console.log('User cancelled home screen install');
            }
            else {
                console.log('User added to home screen');
            }

            // We no longer need the prompt.  Clear it up.
            deferredPrompt = null;
            });
        }
    });

    </script>
    <script>

    // CODELAB: Register service worker.
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('{!! asset("/service-worker.js") !!}')
                .then((reg) => {
                console.log('Service worker registered.', reg);
                });
        });
    }
    </script>
        
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