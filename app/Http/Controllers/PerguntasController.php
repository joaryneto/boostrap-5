<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Galeria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\respostas;
use App\Models\Perguntas;
use App\Models\Perguntas_alternativa;
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
         $datos_porc = [];
         if(@count($realizada) == 0){

            foreach($request->all() as $key => $a){

                if($key != "_token" && $key != "pergunta" && $key != "qtd" && $key != "descricao" && $key != "image"){


                        if($perguntas->tipo == 1){
                            $alternativas = Perguntas_alternativa::select('porcentagem')->where('id', $a)->first();
                            $datos_porc[] = $alternativas->porcentagem;
                        }

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

            if($perguntas->tipo == 1){

                $pontos = 0;
                $pontos_div = $perguntas->pontos/@count($datos_porc);
                foreach($datos_porc as $key => $p){
                    $pontos += (($p*100)/$pontos_div);
                }

            }elseif($perguntas->tipo == 5){

                $pontos = (2*$request->input('qtd'));

            }elseif($perguntas->tipo == 3){

                $pontos_div = $perguntas->pontos/2;
                $pontos = ($pontos_div*$request->input('qtd'));

            }elseif($perguntas->tipo == 6){

                $qtd    = 20/$perguntas->pontos;
                $pontos = ($qtd*$request->input('qtd'));

            }elseif($perguntas->tipo == 7){

                $pontos = $perguntas->pontos;

            }else{

                $pontos = $perguntas->porcentagem*$count;
            }

            if($perguntas->pontos >= $pontos){
                $pontos = $pontos;
            }
            else{
                $pontos = $perguntas->pontos;
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
                    $name   = date("ymdHis").$files->hashName();
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
            $pontos2 = 0;
            $galeria = Galeria::select('id','image')
            ->where('pergunta_id', $request->input('pergunta'))
            ->where('igreja_classe_id', $this->usuario()->igreja_classe_id)
            ->first();

            if(@count($galeria) > 0){
                $data = json_decode($galeria->image);
            }
    
            foreach($request->all() as $key => $a){
    
              if($key != "_token" && $key != "pergunta" && $key != "qtd" && $key != "descricao" && $key != "image"){
    
                    $g = respostas::select('perguntas_alternativas_id')
                    ->where('perguntas_alternativas_id', $a)
                    ->where('perguntas_id', $request->input('pergunta'))
                    ->where('igreja_classe_id', $this->usuario()->igreja_classe_id)
                    ->first();
    
                    if(@count($g) == 0){

                        if($perguntas->tipo == 1){
                            $alternativas = Perguntas_alternativa::select('porcentagem')->where('id', $a)->first();
                            $datos_porc[] = $alternativas->porcentagem;
                        }

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

            if($request->input('qtd') > $realizada->qtd){
                    $qtd = $request->input('qtd')-$realizada->qtd;
            }
            else{
                    $qtd = $realizada->qtd;
            }

            if($perguntas->tipo == 1){

                $pontos_div = $perguntas->pontos/@count($datos_porc);
                foreach($datos_porc as $key => $p){
                    $pontos2 += (($p*100)/$pontos_div);
                }

            }elseif($perguntas->tipo == 3){

                if($realizada->qtd <= 1){
                    $pontos_div = $perguntas->pontos/2;
                    $pontos2 = ($pontos_div*$qtd);
                }elseif($realizada->qtd >= 2){
                    $pontos_div = 100;
                    $pontos2 = ($pontos_div*$qtd);
                }
            }elseif($perguntas->tipo == 5){

                //$qtd = $request->input('qtd')-$realizada->qtd;

                if($realizada->qtd <= 100){
                    $pontos2 = 2*$qtd;
                }
                if($realizada->qtd >= 100 && 100 > $qtd){
                    $pontos2 = 100;
                }else{
                    $pontos2 = $realizada->pontos;
                }

            }elseif($perguntas->tipo == 6){

                $qtd_pontos     = 20/$perguntas->pontos;
                //$qtd = $request->input('qtd')-$realizada->qtd;
                $pontos2 = ($qtd_pontos*$qtd);

            }elseif($perguntas->tipo == 7){

                //$qtd = $request->input('qtd')-$realizada->qtd;
                $pontos2 = $perguntas->pontos;

            }else{

                $pontos2 = $perguntas->porcentagem*$count;
            }

           if($perguntas->pontos >= $realizada->pontos){

                $realizada3         = perguntas_realizada::find($realizada->id);
                $realizada3->qtd    = $request->input('qtd');
                $realizada3->pontos = $realizada3->pontos+($pontos2);
                $realizada3->save();
    
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
                   $name = "";
                   //$name = Carbon::now()->toDateTimeString().'.'.@$files->extension();
                   $name = date("ymdHis").$files->hashName();
                   $files->move(public_path().'/files/', $name);  
                   $data[] = $name; 
               }
           }

           //dd($galeria, $data);
    
           if(@count($galeria) > 0){
                $file = Galeria::find($galeria->id);
                $file->image=json_encode($data);
                $file->save();
           }else{

                $file= new Galeria();
                $file->sistema = $this->usuario()->sistema;
                $file->image=json_encode($data);
                $file->pergunta_id = $request->input('pergunta');
                $file->igreja_classe_id = $this->usuario()->igreja_classe_id;
                $file->save();
           }

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
