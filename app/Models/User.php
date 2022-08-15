<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use stdClass;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'username',
        'numero_telefone',
        'igreja_classe_id',
        'isVerified',
        'password',
        'permissao',
        'foto',
        'isVerified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public static function usuarioAutenticado()
    {
        return session()->get('usuario');
    }

    public static function GetMembros($usuario){

        if($usuario->permissao == 1){

            $user = igrejas_classe::select('igrejas_classe.id','igrejas_classe.titulo')
            ->whereIn('igrejas_classe.id', [$usuario->igreja_classe_id])
            ->get();

            $dados = [];
            $dados['titulo'] = "ES E PGs";  

            foreach($user as $p){
                $dados['itens'][] = [
                    'id' => $p->id,
                    'nome' => $p->titulo
                ];
            }
        }
        else{

            $user = User::select('id','name')
            ->whereIn('permissao', [1])
            ->get();

            $dados = [];
            $dados['titulo'] = "Membros";  

            foreach($user as $p){
                $dados['itens'][] = [
                    'id' => $p->id,
                    'nome' => $p->name
                ];
            }
        }
        
        return json_decode(json_encode((object) $dados), FALSE);;

    }
}
