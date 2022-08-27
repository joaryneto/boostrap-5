<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Galeria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\respostas;
use App\Models\Perguntas;
use App\Models\perguntas_realizada;
use DateTime;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
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

         $realizada = perguntas_realizada::select('*')
         ->where('pergunta_id', $request->input('pergunta'))
         ->where('igreja_classe_id', $this->usuario()->igreja_classe_id)
         ->first();

         $perguntas = Perguntas::select(DB::raw('(perguntas.pontos/count(*)) as porcentagem'),'perguntas.pontos','perguntas.tipo')
         ->leftjoin('perguntas_alternativas as b','b.pergunta_id','=','perguntas.id')
         ->where('perguntas.id', $request->input('pergunta'))
         ->groupby('perguntas.id')
         ->first();

         //dd($perguntas);

         //exit;

         $count = 0;

         if(@count($realizada) == 0){

            foreach($request->all() as $key => $a){

            if($key != "_token" && $key != "pergunta" && $key != "qtd" && $key != "descricao" && $key != "image"){


                    $alternativa =  new respostas();
                    $alternativa->sistema = $this->usuario()->sistema;
                    $alternativa->perguntas_alternativas_id = $a;
                    $alternativa->perguntas_id = $request->input('pergunta');
                    $alternativa->cpf = $this->usuario()->cpf;
                    $alternativa->igreja_classe_id = $this->usuario()->igreja_classe_id;
                    $alternativa->save();

                    $count++;

            }

            }

            if($perguntas->tipo == 5){

                $pontos = $perguntas->pontos/100;
                $pontos = $perguntas->pontos*$count;

            }else{

                $pontos = $perguntas->porcentagem*$count;
            }

            $realizada2 = new perguntas_realizada();
            $realizada2->sistema = $this->usuario()->sistema;
            $realizada2->pergunta_id = $request->input('pergunta');
            $realizada2->igreja_classe_id = $this->usuario()->igreja_classe_id;
            $realizada2->descricao = $request->input('descricao');
            $realizada2->qtd = $request->input('qtd');
            $realizada2->status = 1;
            $realizada2->pontos = $pontos;
            $realizada2->save();

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
                    $name = "";
                    //var_dump(@$file->extension());
                    //$name = Carbon::now()->toDateTimeString().'.'.@$files->extension();
                    $name   = date("ymdHis").$files->getClientOriginalName();
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

        }
        elseif(@count($realizada) > 0)
        {

            $data = [];
    
            $galeria = Galeria::select('id','image')
            ->where('pergunta_id', $request->input('pergunta'))
            ->where('igreja_classe_id', $this->usuario()->igreja_classe_id)
            ->first();

            $data = json_decode($galeria->image);
    
            foreach($request->all() as $key => $a){
    
              if($key != "_token" && $key != "pergunta" && $key != "kg" && $key != "descricao" && $key != "image"){
    
                    $g = respostas::select('perguntas_alternativas_id')
                    ->where('perguntas_alternativas_id', $a)
                    ->where('perguntas_id', $request->input('pergunta'))
                    ->where('igreja_classe_id', $this->usuario()->igreja_classe_id)
                    ->first();
    
                    if(@count($g) == 0){
                        $alternativa =  new respostas();
                        $alternativa->sistema = $this->usuario()->sistema;
                        $alternativa->perguntas_alternativas_id = $a;
                        $alternativa->perguntas_id = $request->input('pergunta');
                        $alternativa->cpf = $this->usuario()->cpf;
                        $alternativa->igreja_classe_id = $this->usuario()->igreja_classe_id;
                        $alternativa->save();

                        $count++;
                    }
    
              }
           }

            if($perguntas->tipo == 5){

                $pontos = (2*$request->input('qtd'));

            }else{

                $pontos = $perguntas->porcentagem*$count;
            }

           $realizada3 = perguntas_realizada::find($realizada->id);
           $realizada3->qtd    = $request->input('qtd');
           $realizada3->pontos = $realizada3->pontos+($perguntas->pontos*$count);
           $realizada3->save();
    
    
           if($request->hasfile('image'))
           {
                $this->validate($request, [
                        'image' => 'required',
                        'image.*' => 'mimes:jpg,png,JPG'
                ]);
               
               if(!file_exists(public_path().'/files/')) { 
                   File::makeDirectory(public_path().'/files/');
               } 
    
               foreach($request->file('image') as $files)
               {
                   $name = "";
                   //$name = Carbon::now()->toDateTimeString().'.'.@$files->extension();
                   $name = date("ymdHis").$files->getClientOriginalName();
                   $files->move(public_path().'/files/', $name);  
                   $data[] = $name; 
               }
           }

           //dd($galeria, $data);
    
            $file = Galeria::find($galeria->id);
            $file->image=json_encode($data);
            $file->save();

        }

         return redirect('/inicio');
    }

    public function edit(Request $request){

        $data = [];

        //dd($request->input('pergunta'));

        /*$realizada = perguntas_realizada::find();
        $realizada->sistema = $this->usuario()->sistema;
        $realizada->pergunta_id = $request->input('pergunta');
        $realizada->igreja_classe_id = $this->usuario()->igreja_classe_id;
        $realizada->descricao = $request->input('descricao');
        $realizada->kg = $request->input('kg');
        $realizada->status = 1;
        $realizada->save();
        */

        $galeria = Galeria::select('id','image')->where('pergunta_id')->where('igreja_classe_id')->first();
        $data[] = json_encode($galeria->image);

        foreach($request->all() as $key => $a){

          if($key != "_token" && $key != "pergunta" && $key != "kg" && $key != "descricao" && $key != "image"){

                $g = respostas::select('perguntas_alternativas_id')
                ->where('perguntas_alternativas_id', $a)
                ->where('perguntas_id', $request->input('pergunta'))
                ->where('igreja_classe_id', $this->usuario()->igreja_classe_id)
                ->first();

                if(@count($g) == 0){

                    $alternativa =  new respostas();
                    $alternativa->sistema = $this->usuario()->sistema;
                    $alternativa->perguntas_alternativas_id = $a;
                    $alternativa->perguntas_id = $request->input('pergunta');
                    $alternativa->cpf = $this->usuario()->cpf;
                    $alternativa->igreja_classe_id = $this->usuario()->igreja_classe_id;
                    $alternativa->save();

                }

          }
       }


       if($request->hasfile('image'))
       {
            $this->validate($request, [
                    'image' => 'required',
                    'image.*' => 'mimes:jpg,png,JPG'
            ]);
           
           if(!file_exists(public_path().'/files/')) { 
               File::makeDirectory(public_path().'/files/');
           } 

           foreach($request->file('image') as $files)
           {
               //var_dump(@$file->extension());
               //$name = time().'.'.@$files->extension();
               $name   = Carbon::now()->toDateTimeString().$files->getClientOriginalName();
               $files->move(public_path().'/files/', $name);  
               $data[] = $name; 
           }
       }

        $file = Galeria::find($galeria->id);
        $file->image=json_encode($data);
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
        //$realizada->igreja_classe_id = $this->usuario()->igreja_classe_id;
        $realizada->status = 2;
        $realizada->save();

        return redirect('/inicio');
    }
}
