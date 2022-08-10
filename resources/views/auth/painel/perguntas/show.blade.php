<div class="page-content">
@if($alternativas->total == 0)
        <a class=" text-center d-block p-4 bg-light" href="#">
            
            Nenhuma atividade encontrado
           
        </a>
@endif
        <br>
    @if(@count($alternativas) > 0)
            
        @foreach($alternativas as $r)

        @if(@count($r->perguntas) > 0)

        @foreach ($r->perguntas as $key => $p)
<div class="row mb-3">
<div class="col-md-12">
    <div class="card pmd-card">
        <div class="card-header">
            <div class="row">
                <div class="col-7">
                    <h3 class="f-light mb-3">{{ $p->ordem }}° {{ $p->titulo }}</h3>
                </div>
                <div class="col-12 text-left">
                    <h4>{{ $p->descricao }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
        <form method="post" action="{{ route('perguntas.store') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="pergunta" value="{{ $p->id }}" />
                <!-- Reflow table -->
                        <div class="table-responsive"> 
                        <br>
                        @if($p->tipo == 1 || $p->tipo == 2 || $p->tipo == 3)
                            <table class="table pmd-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @if(@count($r->grupo) > 0)
                                            @foreach ($r->grupo as $key => $a)
                                                <th>{{ $a->titulo }}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
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
                                                        @elseif($p->tipo == 2)
                                                        <label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
                                                            <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}">
                                                        </label>
                                                        @elseif($p->tipo == 3)
                                                        <label class=".pmd-textfield-floating-label">
                                                            <textarea name="{{ $c->id  }}" value="{{ $c->id  }}"></textarea>
                                                        </label>
                                                        @elseif($p->tipo == 4)
                                                        <label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
                                                            <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}">
                                                        </label>
                                                        @endif
                                                    </td>
                                                
                                                @endforeach                                                        
                                            </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @endif
                            @if($p->tipo == 4)

                                @if(@count($r->linha->itens) > 0)

                                    @foreach ($r->linha->itens as $key => $b)

                                            @foreach ($b->opcoes as $key => $c)
                                                        @if($p->tipo == 4)
                                                        <div class="checkbox pmd-default-theme">
                                                            <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                                <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}">
                                                                <span>{{ $b->titulo }}</span>
                                                            </label>
                                                        </div>
                                                        @endif                                                
                                                @endforeach          
                                    @endforeach
                                @endif

                            @endif
                            @if($p->tipo == 3)

                                @if(@count($r->linha->itens) > 0)

                                    @foreach ($r->linha->itens as $key => $b)

                                            @foreach ($b->opcoes as $key => $c)
                                                        @if($p->tipo == 4)
                                                        <div class="checkbox pmd-default-theme">
                                                            <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                                <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}">
                                                                <span>{{ $b->titulo }}</span>
                                                            </label>
                                                        </div>
                                                        @endif
                                                    @php 
                                                        $count++
                                                    @endphp
                                                
                                                @endforeach          
                                    @endforeach
                                @endif

                            @endif
                            @if($p->tipo == 3)
                            <div class="form-group pmd-textfield">
                                    <label for="regular1" class="control-label">
                                    Informar Quantidade
                                    </label>
                                <input type="numeric" maxlength="4" name="kg" value="" class="form-control">
                            </div>
                            
                            @endif
                            <div class="form-group pmd-textfield">
                                    <label for="regular1" class="control-label">
                                    Descrição
                                    </label>
                                <textarea class="form-control" name="descricao" value="descricao"></textarea>
                            </div>
                            <div class="form-group pmd-textfield">
                            <label class="form-group pmd-textfield" for="file{{$p->id}}">Upload de Imagens</label>
                            <input id="file" type="file" name="image[]" class="" multiple required>
                            </div>
                    </div>
                <div class="card-footer p-0 border-0">
                    <button class="btn btn-primary btn-block btn-lg rounded-0" type="submit">Enviar</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        </div>
        @endforeach

        @endif
    @endforeach
    @endif
    <div class="footer-wrapper" style="margin-top: -100px;">
        <div class="footer">
            <div class="row mx-0">
                <div class="col">
                    
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="row mx-0">
                <div class="col  text-center">
                    Todos os direitos reservados @ {{ date('Y')}}, Igreja Adventista
                </div>
            </div>
        </div>
    </div>
</div>