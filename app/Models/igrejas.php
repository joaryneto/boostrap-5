<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\respostas;
use App\Models\Perguntas;

class igrejas extends Model
{
    use HasFactory;

    protected $table = 'igrejas';


    public static function GetIgrejasRank()
    {
        $igrejas = igrejas::select('igrejas.id','igrejas.titulo','projetos_vinculados.projeto_id')
                ->join('projetos_vinculados','projetos_vinculados.igreja_id','igrejas.id')
                ->orderby('total')
                ->get();

        //dd($igrejas);
                
        $dados = [];
        $count1 = 0;
        $count2 = 0;
        foreach($igrejas as $i){

            $perguntas = Perguntas::select('id','titulo', 'descricao','tipo','projeto_id')
            ->where('projeto_id', $i->projeto_id)
            ->get();
        
            $dados[$i->id] = [
                'respondido' => 0,
                'nao' => 0
            ];

            foreach($perguntas as $a){
    
                $respostas = respostas::select('perguntas_id', 'created_at')
                                ->where('perguntas_id', $a->id)
                                ->first();

                if($a->id == @$respostas->perguntas_id){
                    $dados[$i->id]['respondido'] = $count1++;
                }
                else{
                    $dados[$i->id]['nao'] = $count2++;
                }

                $dados[$i->id][$a->id]['teste'] = $respostas;
            }
        }

        return $dados;

    }
}
