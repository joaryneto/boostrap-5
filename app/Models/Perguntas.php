<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\respostas;
use App\Models\Perguntas_alternativa;

class Perguntas extends Model
{
    use HasFactory;


    protected $table = 'perguntas';


    public static function getPerguntas($usuario = null){

        $perguntas = Perguntas::select('id','titulo', 'descricao','tipo','ordem')
            ->orderBy('ordem')
            ->get();

        $dados = [];
        $count = 0;
        foreach($perguntas as $b){

            $realizada = DB::table('perguntas_realizadas')
            ->select('id','pergunta_id')
            ->where('pergunta_id', $b->id)
            ->whereIn('igreja_classe_id', [$usuario->igreja_classe_id])
            ->first();

            //dd(@count($respostas));

            if(@count($realizada) > 0){ $id = $realizada->id;}else{ $id = null;}

            //if(@count($realizada) != 0){

                $gruposs = DB::table('perguntas_grupos')
                ->select('id','perguntas_id','titulo', 'descricao')
                ->where('perguntas_id', $b->id)
                ->get();

                if(@count($gruposs) > 0){

                    $dados[$b->id]['perguntas'][$b->id] = (object)[
                        'id' => $b->id,
                        'titulo' => $b->titulo,
                        'descricao' => $b->descricao,
                        'tipo' => $b->tipo,
                        'ordem' => $b->ordem,
                        'realizada_id' => $id
                    ];

                    foreach($gruposs as $grupo){

                    
                    $dados[$b->id]['grupo'][$grupo->id]['id'] = $grupo->id;
                    $dados[$b->id]['grupo'][$grupo->id]['titulo'] = $grupo->titulo;
                    
                    $linhas = DB::table('perguntas_linhas')
                        ->select('id','perguntas_id','titulo', 'descricao')
                        ->where('perguntas_id', $grupo->perguntas_id)
                        ->get();

                        foreach($linhas as $key => $d)
                        {

                            $alternativa = DB::table('perguntas_alternativas')
                                ->select('id','grupos_id','titulo', 'descricao')
                                ->where('linhas_id', $d->id)
                                ->get();

                            foreach($alternativa as $key => $c){

                                $respostas = respostas::select('id','perguntas_alternativas_id','perguntas_id',)
                                ->where('perguntas_alternativas_id', $c->id)
                                ->whereIn('igreja_classe_id', [$usuario->igreja_classe_id])
                                ->first();

                                if(@count($respostas) > 0){ $status = true;}else{ $status=false;}

                                $dados[$b->id]['linha']['itens'][$d->id]['titulo'] = $d->titulo;
                                $dados[$b->id]['linha']['itens'][$d->id]['id'] = $d->id;
                                $dados[$b->id]['linha']['itens'][$d->id]['opcoes'][$c->id] = (object)[ 
                                    'id' => $c->id,
                                    'status' => $status
                                ];
                            }
                        }
                    }
                }
                $count++;
            //}
        }

        $dados['total'] = $count;

       //dd(json_decode(json_encode((object) $dados), FALSE));

        return json_decode(json_encode((object) $dados), FALSE);
    }


    public static function getPerguntasAdmin($usuario = null){

        $perguntas = Perguntas::
            select('perguntas.id',
             'perguntas.titulo', 
             'igrejas_classe.titulo as nome_classe',
             'perguntas.descricao',
             'perguntas.tipo',
             'perguntas.ordem',
             'perguntas_realizadas.id as realizado_id',
             'perguntas_realizadas.pontos',
             'perguntas_realizadas.igreja_classe_id',
             'galerias.image',
             'perguntas.ordem')
            ->join('perguntas_realizadas','perguntas_realizadas.pergunta_id','=','perguntas.id')
            ->join('igrejas_classe','igrejas_classe.id','=','perguntas_realizadas.igreja_classe_id')
            ->join('galerias','galerias.pergunta_id','=','perguntas_realizadas.pergunta_id')
            ->whereIn('perguntas_realizadas.igreja_classe_id', [$usuario->igreja_classe_id])
            ->orderBy('perguntas.ordem')
            ->get();

        //dd($perguntas);

        $dados = [];
        $count = 0;
        foreach($perguntas as $b){

                $gruposs = perguntas_grupos::select('id','perguntas_id','titulo', 'descricao')
                ->where('perguntas_id', $b->id)
                ->get();

                if(@count($gruposs) > 0){

                    $poSum = perguntas_realizada::GetPontos($b->id, $b->igreja_classe_id);

                    $dados[$b->id]['perguntas'][$b->id] = (object)[
                        'id' => $b->id,
                        'titulo' => $b->titulo,
                        'descricao' => $b->descricao,
                        'nome_classe' => $b->nome_classe,
                        'tipo' => $b->tipo,
                        'pontos' => $poSum->pontos,
                        'realizado_id' => $b->realizado_id,
                        'image' => json_decode($b->image),
                        'ordem' => $b->ordem,
                    ];

                    foreach($gruposs as $grupo){

                    
                    $dados[$b->id]['grupo'][$grupo->id]['id'] = $grupo->id;
                    $dados[$b->id]['grupo'][$grupo->id]['titulo'] = $grupo->titulo;
                    
                    $linhas = perguntas_linhas::select('id','perguntas_id','titulo', 'descricao')
                        ->where('perguntas_id', $grupo->perguntas_id)
                        ->get();

                        foreach($linhas as $key => $d)
                        {

                            $alternativa = perguntas_alternativa::select('id','grupos_id','titulo', 'descricao')
                                ->where('linhas_id', $d->id)
                                ->get();

                            foreach($alternativa as $key => $c){

                                $respostas = respostas::select('id','perguntas_alternativas_id','perguntas_id',)
                                ->where('perguntas_alternativas_id', $c->id)
                                ->first();

                                if(@count($respostas) > 0){ $status = true;}else{ $status=false;}
                                //dd($respostas->id);

                                $dados[$b->id]['linha']['itens'][$d->id]['titulo'] = $d->titulo;
                                $dados[$b->id]['linha']['itens'][$d->id]['id'] = $d->id;
                                $dados[$b->id]['linha']['itens'][$d->id]['opcoes'][$c->id] = (object)[ 
                                    'id' => $c->id,
                                    'status' => $status
                                ];
                            }
                        }
                    }
                }
                $count++;
            //}
        }

        $dados['total'] = $count;

       return json_decode(json_encode((object) $dados), FALSE);
    }

    public static function GetPerguntasRespondidas()
    {
        $perguntas = perguntas::select('id','titulo', 'descricao','tipo')
            ->get();

        $dados = [];
        $dados['respondido'] = 0;
        $dados['nao'] = 0;
        foreach($perguntas as $a){

            $respostas = DB::table('respostas')
                            ->select('perguntas_id', 'created_at')
                            ->where('perguntas_id', $a->id)
                            ->first();

            if($a->id == @$respostas->perguntas_id){
                $dados['respondido']++;
            }
            else{
                $dados['nao']++;
            }

        }

        return json_decode(json_encode((object) $dados), FALSE);

    }
}
