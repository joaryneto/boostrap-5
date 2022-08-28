<section class="row component-section">
    <div class="col-md-12"> 
        <div class="component-box">
@if($alternativas->total == 0)
        <a class=" text-center d-block p-4 bg-light" href="#">
            
            Nenhuma atividade encontrado
           
        </a>
@endif
        <br>
<div class="card pmd-card text-center mb-4"> 
    <!-- Card body --> 
    <div class="card-body pmd-floating-content-wrapper"> 
        <i class="pmd-icon-circle bg-primary  pmd-floating-content-tc">
            <img src="{{ asset('assets/img/logo.jpg') }}" class="rounded-circle" alt="" width="100">
        </i>	 
        <h2></h2>
        <h3 class="card-title display-4 pt-3"><strong>{{ $dados_pontos  }} Pontos</strong></h3> 
        <p class="card-subtitle"></p>  
    </div>
</div>
@if(@count($alternativas) > 0)
    
@foreach($alternativas as $r)

@if(@count($r->perguntas) > 0)

        
@if(@count($r->perguntas))
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
                                @if(@count($r->linha->itens) > 0)

                                    @foreach ($r->linha->itens as $key => $b)

                                    <tr class="table-active">
                                        <th scope="row">{{ $b->titulo }}</th>

                                            @foreach ($b->opcoes as $key => $c)
                                        
                                            
                                                    <td>
                                                        @if($p->tipo == 1)
                                                        <label class="radio-inline pmd-radio pmd-radio-ripple-effect">
                                                            <input type="radio" name="{{ $b->id }}" id="inlineRadio3" value="{{ $c->id  }}"
                                                            @if($c->status == true)
                                                            checked 
                                                            @endif
                                                            @if($p->realizada_id != null)
                                                            disabled
                                                            @endif
                                                            >
                                                            <span for="inlineRadio3"></span>
                                                        </label>
                                                        @elseif($p->tipo == 2)
                                                        <label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
                                                            <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}"
                                                            @if($c->status == true)
                                                            checked 
                                                            disabled
                                                            @endif
                                                        >
                                                        </label>
                                                        @elseif($p->tipo == 3)
                                                        <label class=".pmd-textfield-floating-label">
                                                            <textarea name="{{ $c->id  }}" value="{{ $c->id  }}"></textarea>
                                                        </label>
                                                        @elseif($p->tipo == 4)
                                                        <label class="checkbox-inline pmd-checkbox pmd-checkbox-ripple-effect">
                                                            <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}" 
                                                            @if($c->status == true)
                                                            checked 
                                                            disabled
                                                            @endif
                                                            >
                                                        </label>
                                                        @elseif($p->tipo == 5)
                                                        <label class=".pmd-textfield-floating-label">
                                                            <textarea name="{{ $c->id  }}" value="{{ $c->id  }}"></textarea>
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
                                                                <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}"
                                                                @if($c->status == true)
                                                                checked 
                                                                disabled
                                                                @endif
                                                                >
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
                                                                <input type="checkbox" name="{{ $c->id  }}" value="{{ $c->id  }}"
                                                                @if($c->status == true)
                                                                checked 
                                                                disabled
                                                                @endif
                                                                >
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
                                <input type="numeric" maxlength="4" name="qtd" value="{{ $p->qtd }}" class="form-control">
                            </div>
                            
                            @endif
                            @if($p->tipo == 5)
                            <div class="form-group pmd-textfield">
                                    <label for="regular1" class="control-label">
                                    Informar Quantidade
                                    </label>
                                <input type="numeric" maxlength="4" name="qtd" value="{{ $p->qtd }}" class="form-control">
                            </div>
                            @endif
                            @if($p->tipo == 6)
                            <div class="form-group pmd-textfield">
                                    <label for="regular1" class="control-label">
                                    Informar Quantidade
                                    </label>
                                <input type="numeric" maxlength="4" name="qtd" value="{{ $p->qtd }}" class="form-control">
                            </div>
                            
                            @endif
                            <div class="form-group pmd-textfield">
                                    <label for="regular1" class="control-label">
                                    Descrição
                                    </label>
                                <textarea class="form-control" name="descricao" value="{{ $p->input_descricao }}"></textarea>
                            </div>
                            @if(@count($p->image) > 0)
                            <div class="input-group pmd-input-group-outline">
                                <h2>Fotos</h2>
                                </div>
                                <div class="input-group pmd-input-group-outline">
                                    
                                    <div class="parent-container">
                                        @foreach($p->image as $key => $img)
                                            <a href="{{ asset('files/'.$img.'') }}" target="_brank">
                                                <img class="img-thumbnail" src="{{ asset('files/'.$img.'') }}">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
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

        @endif
    @endforeach
    @endif
</div>
</div>
</section>