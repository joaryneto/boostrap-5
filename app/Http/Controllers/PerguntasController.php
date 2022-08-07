<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\respostas;
use App\Models\Perguntas;
use App\Models\perguntas_realizada;
use Illuminate\Support\Facades\File;


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
         
         //dd($request);

         $realizada = new perguntas_realizada();
         $realizada->pergunta_id = $request->input('pergunta');
         $realizada->igreja_classe_id = $this->usuario()->igreja_classe_id;
         $realizada->save();

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

            /*$this->validate($request, [
                    'image' => 'required',
                    'image.*' => 'mimes:jpg,png,JPG'
            ]);*/


            if(@count($request->image) > 0)
            {
                
                if(!file_exists(public_path().'/files/')) { 
                    $objProjetoDiretorio = File::makeDirectory(public_path().'/files/');
                } 

                foreach($request->file('image') as $file)
                {
                    $name = time().'.'.$file->extension();
                    $file->move(public_path().'/files/', $name);  
                    $data[] = $name;  
                }
            }


            $file= new Galeria();
            $file->image=json_encode($data);
            $file->pergunta_id = $request->input('pergunta');
            $file->igreja_classe_id = $this->usuario()->igreja_classe_id;
            $file->save();

         }

         return redirect('/perguntas');
    }


    public function showAdm()
    {
        if(empty($this->usuario()->cpf)){
            return redirect('/');
        }

        $dados = Perguntas::getPerguntasAdmin($this->usuario());

        //dd(json_decode(json_encode((object) $dados), FALSE));

        return view('auth.painel.admin.show', [
            'alternativas' => $dados
        ]);
    }

    public function AdicionarPontos(Request $request){

        $realizada = perguntas_realizada::find($request->input('pergunta'));
        $realizada->pontos = $request->input('pontos');
        $realizada->igreja_classe_id = $this->usuario()->igreja_classe_id;
        $realizada->save();

        return redirect('/perguntas/admin');
    }
}
