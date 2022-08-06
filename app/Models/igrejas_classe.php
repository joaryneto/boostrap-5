<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igrejas_classe extends Model
{
    use HasFactory;

    protected $table = 'igrejas_classe';


    public static function GetClasse()
    {
        $dados = igrejas_classe::select('*')->get();

        return $dados;
    }
}
