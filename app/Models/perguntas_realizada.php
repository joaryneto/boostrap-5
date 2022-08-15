<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perguntas_realizada extends Model
{
    use HasFactory;

    protected $table = 'perguntas_realizadas';

    protected  $primaryKey = 'id';


    protected $fillable = [
        'id',
        'pergunta_id',
        'igreja_classe_id',
        'descricao',
        'pontos'
    ];


    public static function GetPontos($pergunta = null, $igreja_classe_id = null){

        $pontos = perguntas_realizada::selectRaw('SUM(pontos) as pontos')
        ->where('pergunta_id', $pergunta)
        ->whereIn('igreja_classe_id', [$igreja_classe_id])
        ->first();

        return $pontos;
    }
}
