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
        'email',
        'username',
        'numero_telefone',
        'isVerified',
        'password',
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

            $user = igrejas_classe::select('igreja_classe.titulo')
            ->whereIn('igreja_classe.id', [$usuario->igreja_classe_id])
            ->get();

            $dados = [];
            $dados['titulo'] = "ES E PGs";  

            foreach($user as $p){
                $dados['itens'][] = [
                    'nome' => $p->titulo
                ];
            }
        }
        else{

            $user = User::select('name')
            ->whereIn('igreja_classe_id', [$usuario->igreja_classe_id])
            ->get();

            $dados = [];
            $dados['titulo'] = "Membros";  

            foreach($user as $p){
                $dados['itens'][] = [
                    'nome' => $p->name
                ];
            }
        }
        
        return json_decode(json_encode((object) $dados), FALSE);;

    }
}
