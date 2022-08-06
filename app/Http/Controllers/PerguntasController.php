<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\respostas;
use App\Models\Perguntas;

class PerguntasController extends Controller
{
    //
    public function show()
    {
        if(empty($this->usuario()->cpf)){
            return redirect('/');
        }

        $dados = Perguntas::getPerguntas($this->usuario());

        //dd(json_decode(json_encode((object) $dados), FALSE));

        return view('auth.painel.perguntas.show', [
            'alternativas' => $dados
        ]);
    }

    public function store(Request $request){

         $dados = [];
         
         //dd($request->all());

         foreach($request->all() as $key => $a){

           if($key != "_token" && $key != "pergunta"){

              $alternativa =  new respostas();
              $alternativa->perguntas_alternativas_id = $a;
              $alternativa->perguntas_id = $request->input('pergunta');
              $alternativa->cpf = $this->usuario()->cpf;
              $alternativa->igreja_id = $this->usuario()->igreja_id;
              $alternativa->igreja_classe_id = $this->usuario()->igreja_classe_id;
              $alternativa->save();

           }
         }

         return redirect('/perguntas');
    }

    public function Adicionar(Request $request){



    }
}
