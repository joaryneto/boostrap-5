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
                             @if($alternativas->total == 0)
                               Nenhuma pergunta encontrado
                             @endif
                            </a>
                            <br>
                        @if(@count($alternativas) > 0)
                              
                            @foreach($alternativas as $r)

                            @if(@count($r->perguntas) > 0)

                            @foreach ($r->perguntas as $key => $p)
                            <form method="post" action="{{ route('perguntas.store') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="pergunta" value="{{ $p->id }}" />
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
                                                            @if(@count($r->grupo) > 0)
                                                                @foreach ($r->grupo as $key => $a)
                                                                    <th>{{ $a->titulo }}</th>
                                                                @endforeach
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $count = 0;
                                                    @endphp



                                                    @if(@count($r->linha->itens) > 0)
                                                        @foreach ($r->linha->itens as $key => $b)

                                                            <tr class="table-active">
                                                                <th scope="row">{{ $b->titulo }}</th>
                                                                    @foreach ($b->opcoes as $key => $c)
                                                                
                                                                        <td>
                                                                            @if($p->tipo == 1)
                                                                            <label class="radio-inline pmd-radio pmd-radio-ripple-effect">
                                                                                <input type="radio" name="{{ $b->id }}" id="inlineRadio3" value="{{ $c->id  }}">
                                                                                <span for="inlineRadio3"></span>
                                                                            </label>
                                                                            @else
                                                                            <label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
                                                                                <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}">
                                                                            </label>
                                                                            @endif
                                                                        </td>
                                                                        @php 
                                                                            $count++
                                                                        @endphp
                                                                        
                                                            @endforeach

                                                                    
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer p-0 border-0">
                                    <button class="btn btn-primary btn-block btn-lg rounded-0" type="submit">Proximo</button>
                                </div>
                            </form>
                            @endforeach
                        
                            @endif
                        @endforeach
                        @endif
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