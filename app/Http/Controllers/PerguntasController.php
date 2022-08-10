<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\respostas;
use App\Models\Perguntas;
use App\Models\perguntas_realizada;
use Illuminate\Support\Facades\File;
use Storage;


class PerguntasController extends Controller
{
    //
    public function show()
    {
        if(empty($this->usuario()->cpf)){
            return redirect('/');
        }

        $dados = Perguntas::getPerguntas($this->usuario());

        return view('auth.painel.perguntas.show', [
            'alternativas' => $dados
        ]);
    }

    public function store(Request $request){

         $dados = [];

         //dd($request->input('pergunta'));

         $realizada = new perguntas_realizada();
         $realizada->sistema = $this->usuario()->sistema;
         $realizada->pergunta_id = $request->input('pergunta');
         $realizada->igreja_classe_id = $this->usuario()->igreja_classe_id;
         $realizada->descricao = $request->input('descricao');
         $realizada->kg = $request->input('kg');
         $realizada->status = 1;
         $realizada->save();

         foreach($request->all() as $key => $a){

           if($key != "_token" && $key != "pergunta" && $key != "kg" && $key != "descricao" && $key != "image"){


              $alternativa =  new respostas();
              $alternativa->sistema = $this->usuario()->sistema;
              $alternativa->perguntas_alternativas_id = $a;
              $alternativa->perguntas_id = $request->input('pergunta');
              $alternativa->cpf = $this->usuario()->cpf;
              $alternativa->igreja_classe_id = $this->usuario()->igreja_classe_id;
              $alternativa->save();

           }

        }

        $this->validate($request, [
                'image' => 'required',
                'image.*' => 'mimes:jpg,png,JPG'
        ]);


        if($request->hasfile('image'))
        {
            
            if(!file_exists(public_path().'/files/')) { 
                File::makeDirectory(public_path().'/files/');
            } 

            foreach($request->file('image') as $files)
            {
                //var_dump(@$file->extension());
                //$name = time().'.'.@$files->extension();
                $name   = time().$files->getClientOriginalName();
                $files->move(public_path().'/files/', $name);  
                $data[] = $name; 
            }
        }


        $file= new Galeria();
        $file->sistema = $this->usuario()->sistema;
        $file->image=json_encode($data);
        $file->pergunta_id = $request->input('pergunta');
        $file->igreja_classe_id = $this->usuario()->igreja_classe_id;
        $file->save();

         return redirect('/inicio');
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

        //dd($request->input('pontos'), $request->input('pergunta'));
        $realizada = perguntas_realizada::find($request->input('pergunta'));
        $realizada->pontos = $request->input('pontos') == null ? '0':$request->input('pontos');
        $realizada->igreja_classe_id = $this->usuario()->igreja_classe_id;
        $realizada->status = 2;
        $realizada->save();

        return redirect('/perguntas/admin');
    }
}
