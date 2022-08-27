<section class="row component-section">
    <div class="col-md-12"> 
        <div class="component-box">
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
                    <form method="post" action="{{ route('perguntas.AdicionarPontos') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="pergunta" value="{{ $p->realizado_id }}" />
                            <!-- Reflow table -->
                                <div class="table-responsive">
                                    <div class="input-group pmd-input-group-outline">
                                        <h2>{{ $p->nome_classe }} </h2><br><br>
                                    </div>
                                    <div class="input-group pmd-input-group-outline">
                                        <h2>Pontos: {{ $p->pontos }}</h2>
                                    </div>
                                    @if($p->tipo == 1 || $p->tipo == 2 || $p->tipo == 3)
                                        <table class="table pmd-table table-sm">
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
                                                                            <input type="radio" name="{{ $b->id }}" id="inlineRadio3" value="{{ $c->id  }}" disabled>
                                                                            <span for="inlineRadio3"></span>
                                                                        </label>
                                                                    @elseif($p->tipo == 2)
                                                                        <label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
                                                                            <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}" 
                                                                            @if($c->status == true)
                                                                            checked 
                                                                            @endif
                                                                            disabled>
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
                                                Quantidade
                                                </label>
                                            <input type="numeric" maxlength="4" name="qtd" value="{{ $p->qtd }}" disabled class="form-control">
                                        </div>
                                        @endif
                                        @if($p->tipo == 5)
                                            <div class="form-group pmd-textfield">
                                                <label for="regular1" class="control-label">
                                                Quantidade
                                                </label>
                                            <input type="numeric" maxlength="4" name="qtd" value="{{ $p->qtd }}" disabled class="form-control">
                                        </div>
                                        @endif
                                        @if($p->tipo == 6)
                                            <div class="form-group pmd-textfield">
                                                <label for="regular1" class="control-label">
                                                Quantidade
                                                </label>
                                            <input type="numeric" maxlength="4" name="qtd" value="{{ $p->qtd }}" disabled class="form-control">
                                        </div>
                                        @endif
                                        <div class="input-group pmd-input-group-outline">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Descrição</span>
                                            </div>
                                            <div class="pmd-textfield pmd-textfield-outline">
                                                <textarea class="form-control" name="descricao" value="{{ $p->descricao }}" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="input-group pmd-input-group-outline">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">Informar Pontos</span>
                                                </label>
                                                <div class="pmd-textfield pmd-textfield-outline">
                                                        <input type="numeric" maxlength="3" name="pontos" value="0" class="form-control"
                                                        @if(auth()->user()->permissao == 2)
                                                        @else
                                                        disabled
                                                        @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group pmd-input-group-outline">
                                        <h2>Fotos</h2>
                                        </div>
                                        <div class="input-group pmd-input-group-outline">
                                            @if(@count($p->image) > 0)
                                            <div class="parent-container">
                                                @foreach($p->image as $key => $img)
                                                    <a href="{{ asset('files/'.$img.'') }}" target="_brank">
                                                        <img class="img-thumbnail" src="{{ asset('files/'.$img.'') }}">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                            </div>
                            @if(auth()->user()->permissao == 2)
                            <div class="card-footer p-0 border-0">
                                <button class="btn btn-primary btn-block btn-lg rounded-0" type="submit">Confirmar</button>
                            </div>
                            @endif
                    </form>      
                </div>
            </div>
        </div>
        @endforeach
    
        @endif
    @endforeach
    @endif        
</div>
<div>
</section>