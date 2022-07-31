<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PerguntasController extends Controller
{
    //
    public function show()
    {
        
        $dados[] = [
            'id' => '20',
            'itens' => [
                '01' => 'false',
                '02' => 'true',
                '03' => 'false',
                '04' => 'false',
            ]
        ];

        $dados = DB::table('perguntas')
            ->select('id','titulo', 'descricao')
            ->get();
        
        $grupos = DB::table('perguntas_grupos')
            ->select('perguntas_id','titulo', 'descricao')
            ->get();

        $dados2 = [];
        foreach($dados as $a){

            $grupos = DB::table('perguntas_grupos')
                ->select('id','perguntas_id','titulo', 'descricao')
                ->where('perguntas_id', $a->id)
                ->get();

            $dados2[] = $grupos;
        }

        $dados3 = [];
        foreach($dados as $b){

            $alternativa = DB::table('perguntas_alternativas')
                ->select('id','perguntas_id','titulo', 'descricao')
                ->where('perguntas_id', $b->id)
                ->get();

            $dados3[] = $alternativa;
        }

        //dd($dados3);

        return view('auth.painel.perguntas.show', [
            'dados' => $dados,
            'grupos' => $dados2,
            'alternativas' => $dados3
        ]);
    }

    public function store(Request $request){

         dd($request);

    }

}
