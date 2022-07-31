@include('layouts.partials.header')
    <div class="loader justify-content-center ">
        <div class="maxui-roller align-self-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="wrapper">

@include('layouts.app-master')

<!-- page main start -->
<div class="page">

    @include('layouts.partials.navbar-direito')


    <div class="page-content">
        <div class="content-sticky-footer">
            <div class="block-title text-center">Gincana SuperAção</div>
                <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card rounded-0 border-0 mb-3">
                            <a class=" text-center d-block p-4 bg-light" href="#">
                                <img src="img/logo.png" alt="" class="mw-100">
                            </a>
                            <br>
                            
                            @foreach ($dados as $p)
                            <form method="post" action="{{ route('perguntas.store') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="card-body">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-7">
                                                <h3 class="f-light mb-3">{{ $p->titulo }}</h3>
                                            </div>
                                            <div class="col-12 text-left">
                                                <a href="#">{{ $p->descricao }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Reflow table -->
                                       
                                        <div class="pmd-card pmd-z-depth">
                                            <div class="table-responsive">
                                                <table class="table pmd-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            @foreach ($grupos[0] as $key => $a)
                                                                <th>{{ $a->titulo }}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($alternativas[0] as $key => $b)
                                                        <tr class="table-active">
                                                            <th scope="row">{{ $b->titulo }}</th>
                                                            

                                                                @php
                                                                    $id = $b->id;
                                                                    $count = 0;
                                                                @endphp
                                                                
                                                                @foreach ($grupos[0] as $a)
                                                                <td>
                                                                    <label class="radio-inline pmd-radio pmd-radio-ripple-effect">
                                                                        <input type="radio" name="[alternativa][{{ $count }}][{{ $a->id }}]" id="inlineRadio3" value="{{ $a->id }}">
                                                                        <span for="inlineRadio3"></span>
                                                                    </label>
                                                                </td>
                                                                
                                                                @endforeach

                                                                @php 
                                                                  $count++
                                                                @endphp
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer p-0 border-0">
                                    <button class="btn btn-primary btn-block btn-lg rounded-0" type="submit">Book Ticket</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


</div>
@include('layouts.partials.footer')

</body>
</html>