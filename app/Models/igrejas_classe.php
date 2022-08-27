<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class igrejas_classe extends Model
{
    use HasFactory;

    protected $table = 'igrejas_classe';

    protected $fillable = [
        'sistema',
        'igreja_id',
        'titulo',
        'descricao',
    ];

    public static function GetClasse()
    {
        $dados = igrejas_classe::select('igrejas.titulo as nome_igreja','igrejas_classe.id','igrejas_classe.titulo',DB::raw("SUM(perguntas_realizadas.pontos) as pontos"))
        ->join('igrejas','igrejas.id','=','igrejas_classe.igreja_id')
        ->leftJoin('perguntas_realizadas','perguntas_realizadas.igreja_classe_id','=','igrejas_classe.id')
        ->orderBy('pontos')
        ->get();

        //dd($dados);

        return $dados;
    }
}
