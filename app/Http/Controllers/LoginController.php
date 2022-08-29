<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\igrejas;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use App\Models\User;
use App\Models\igrejas_classe;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('/')
                ->withErrors(trans('auth.failed'));
        endif;

        /*$token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->messages->create("whatsapp:+556599999104", 
                [
                "from" => "whatsapp:+14194956106", 
                "body" => "Olá, Bom dia, Você tem uma mensagem",
                "messagingServiceSid" => "MGb0e1905bfc6e37632264137e97421908",
                ]
        );

        dd($verification);
        */

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        session()->put('usuario', $user);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    public function login2(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('/login2')
                ->withErrors(trans('auth.failed'));
        endif;

        /*$token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->messages->create("whatsapp:+556599999104", 
                [
                "from" => "whatsapp:+14194956106", 
                "body" => "Olá, Bom dia, Você tem uma mensagem",
                "messagingServiceSid" => "MGb0e1905bfc6e37632264137e97421908",
                ]
        );

        dd($verification);
        */

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        session()->put('usuario', $user);

        Auth::login($user);

        return redirect()->to('/teste'); //$this->authenticated($request, $user);
    }

    public function users(){

        $dados = User::select('*')
        ->whereIn('igreja_classe_id', [$this->usuario()->igreja_classe_id])
        ->whereIn('permissao', ['0','1','2','3'])->get();

        return response()->json($dados);
    }

    public function autenticado(){

        $dados = $this->usuario();

        return response()->json($dados);
    }

    public function GetClasse(){

        //$dados = User::GetMembros($this->usuario());
        if($this->usuario()->permissao == 2){

            $dados = igrejas_classe::select('igrejas_classe.id','igrejas_classe.titulo as name')
            ->whereIn('igrejas_classe.id', [$this->usuario()->igreja_classe_id])
            ->get();

        }
        elseif($this->usuario()->permissao == 3){
           $dados = User::select('id','name','numero_telefone','username', 'password_temporario')->where('permissao', [1,2,3])->get();
        }
        else{

           $dados = User::select('id','name')
           ->whereIn('igreja_classe_id', [$this->usuario()->igreja_classe_id])
           ->where('permissao', '0')->get();
        }

        return response()->json($dados);
    }

    public function store(Request $request)
    {
        $total = User::whereIn('igreja_classe_id',  [$this->usuario()->igreja_classe_id])->count();

        //dd($total);

        if($total >= 15)
        {
             return response()->json([
                "message" => "Sua classe ou PG atingiu limite",
                "errors" => [
                    "count" => "Quantidade maxima atingido 15°"
                ]
            ], 422); 
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            //'cpf' => ['required', 'string', 'max:11'],
            //'email' => ['string', 'max:255', 'unique:users'],
            'numero_telefone' => ['string', 'unique:users'],
            //'igreja_classe_id' => ['string', 'max:255']
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $telefone   = str_replace(' ','',str_replace('-','',str_replace(')','',str_replace('(','',$data['numero_telefone']))));
        //$username   =  explode('@',$data['email']);

        //$post = User::create($request->all());
    
        $post = User::create([
            'sistema' => '07121135002289',
            'name' => $data['name'],
            //'cpf'  => $data['cpf'], 
            //'email' => $data['email'],
            //'username' => $username[0],
            'igreja_classe_id' => $this->usuario()->igreja_classe_id,
            'numero_telefone' => $telefone,
            'password' => '$2a$10$jWbjSwfZvolY4pfLPTSmV.9UDWHaupy8qOI3DEHj0rLj9IsudyoLa', // Senha: 123456
        ]);

        return response()->json($post);
    }

    public function criar(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:11'],
            'email' => ['string', 'max:255', 'unique:users'],
            'numero_telefone' => ['string', 'unique:users'],
            'igreja_classe_id' => ['required','string', 'max:255']
            //'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $telefone   = str_replace(' ','',str_replace('-','',str_replace(')','',str_replace('(','',$data['numero_telefone']))));
        $username   =  explode('@',$data['email']);

        //$post = User::create($request->all());
    
        //dd($data);

        $post = User::create([
            'sistema' => '07121135002289',
            'name' => $data['name'],
            'cpf'  => $data['cpf'], 
            'email' => $data['email'],
            'username' => $username[0],
            'igreja_classe_id' => $data['igreja_classe_id'],
            'numero_telefone' => $telefone,
            'password' => '123456', // Senha: 123456
        ]);

        return redirect()->to('/inicio');
    }

    public function StoreSupervisor(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['string'],
            'email' => ['string', 'max:255', 'unique:users'],
            'numero_telefone' => ['string', 'unique:users'],
            'igreja_classe_id' => ['required','array'],
            'permissao' => ['string'],
            //'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $telefone   = str_replace(' ','',str_replace('-','',str_replace(')','',str_replace('(','',$data['numero_telefone']))));
        $username   =  explode('@',$data['email']);

        //$post = User::create($request->all());

        $senha = rand( 1000, 9999 );
        //dd($data['password']);

        $classe = implode(",",$data['igreja_classe_id']);
    
        $post = User::create([
            'sistema' => '07121135002289',
            'name' => $data['name'],
            'cpf'  => $data['cpf'], 
            'email' => $data['email'],
            'username' => $username[0],
            'igreja_classe_id' => $classe,
            'numero_telefone' => $telefone,
            'password' => $senha, // Senha: 123456
            'password_temporario' => $senha,
            'permissao' => $data['permissao'],
        ]);

        return response()->json($post);
    }

    public function pg(){

        $dados = igrejas_classe::select('*')->get();

        return response()->json($dados);
    }

    public function igrejas(){

        $dados = igrejas::select('*')
        ->get();

        return response()->json($dados);
    }

    public function CreatePG(Request $request)
    {
        $data = $request->validate([
            'igreja_id' => ['required','integer'],
            'titulo' => ['required', 'string', 'max:30', 'unique:igrejas_classe'],
        ]);

        $post = igrejas_classe::create([
            'sistema' => '07121135002289',
            'igreja_id' => $data['igreja_id'],
            'titulo' => $data['titulo'],
        ]);

        return response()->json($post);
    }

    public function delete($id)
    {
        User::destroy($id);
    
        return response()->json("ok");
    }
    

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }

    public function verify(Request $request)
    {
        //dd($request);

        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'numero_telefone' => ['required', 'string'],
        ]);

        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create([ 
                'to' => "+55".$data['numero_telefone'],
                'code' => $data['verification_code']
            ]);

        if ($verification->valid) {
            $user = tap(User::where('numero_telefone', $data['numero_telefone']))->update(['isVerified' => true]);
            /* Authenticate user */
            Auth::login($user->first());
            return redirect()->intended()->with(['message' => 'Telefone verificado']);
        }

        return back()->with(['numero_telefone' => $data['numero_telefone'], 'error' => 'Invalid verification code entered!']);
    }
}