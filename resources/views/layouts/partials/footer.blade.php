    <script src="{!! url('assets/ectecnologia/js/jquery-3.2.1.min.js') !!}"></script>
    <script src="{!! url('assets/ectecnologia/js/popper.min.js') !!}"></script>
    <script src="{!! url('assets/ectecnologia/vendor/bootstrap-4.3.1/js/bootstrap.min.js') !!}"></script>
    
    <!-- Cookie jquery file -->
    <script src="{!! url('assets/ectecnologia/vendor/cookie/jquery.cookie.js') !!}"></script>
    
    <!-- sparklines chart jquery file -->
    <script src="{!! url('assets/ectecnologia/vendor/sparklines/jquery.sparkline.min.js') !!}"></script>
    
    <!-- Circular progress gauge jquery file -->
    <script src="{!! url('assets/ectecnologia/vendor/circle-progress/circle-progress.min.js') !!}"></script>
    
    <!-- Swiper carousel jquery file -->
    <script src="{!! url('assets/ectecnologia/vendor/swiper/js/swiper.min.js') !!}"></script>
    
    <!-- Application main common jquery file -->
    <script src="{!! url('assets/ectecnologia/js/main.js') !!}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $('.telefone').inputmask('(99) 99999-9999');
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

</body>
</html>