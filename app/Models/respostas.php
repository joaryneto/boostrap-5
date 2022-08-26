<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class respostas extends Model
{
    use HasFactory;

    protected $table = 'respostas';

    protected $fillable = [
        'id',
        'perguntas_alternativas_id',
        'perguntas_id',
        'ugreja_id',
        'igreja_classe_id',
        'cpf'
    ];
}
