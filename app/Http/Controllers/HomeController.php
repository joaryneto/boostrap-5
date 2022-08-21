<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perguntas;
use App\Models\igrejas;
use App\Models\igrejas_classe;
use App\Models\Perguntas_alternativa;
use App\Models\perguntas_realizada;
use App\Models\respostas;
use App\Models\User;

class HomeController extends Controller
{
    public function index() 
    {
        $dados  = null;
        $perfil = null; 

        if(auth()->guest() == true){
            return redirect('/');
        }

        if(auth()->user()->permissao == 2 || auth()->user()->permissao == 3){
            $dados  = Perguntas::getPerguntasAdmin($this->usuario());
            $perfil = User::GetMembros($this->usuario());

        }else{
            $dados  = Perguntas::getPerguntas($this->usuario());
            $perfil = User::GetMembros($this->usuario());
        }

        $index  = Perguntas::GetPerguntasRespondidas();
        $rank   = igrejas::GetIgrejasRank();
        $pontos = perguntas_realizada::GetPontosTotal(auth()->user()->igreja_classe_id);
        $classe = igrejas_classe::GetClasse();

        return view('home.index', [
            'dados_perfil' => $perfil,
            'dados_index' => $index,
            'dados_rank' => $rank,
            'dados_classe' => $classe,
            'dados_pontos' => $pontos,
            'alternativas' => $dados
        ]);
    }
}