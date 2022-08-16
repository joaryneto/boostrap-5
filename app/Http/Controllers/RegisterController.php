<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\igrejas_classe;
use Twilio\Rest\Client;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        /*$user = User::create($request->validated());

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");*/

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:11'],
            'email' => ['string', 'max:255'],
            'numero_telefone' => ['string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $telefone   = str_replace(' ','',str_replace('-','',str_replace(')','',str_replace('(','',$data['numero_telefone']))));
        $username   =  explode('@',$data['email']);

        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            //->create('', "sms");
            ->create("+55".$telefone, "sms");

        $user = User::create([
            'name' => $data['name'],
            'cpf'  => $data['cpf'], 
            'email' => $data['email'],
            'username' => $username[0],
            'numero_telefone' => $telefone,
            'password' => $data['password'],
        ]);

        auth()->login($user);

        return redirect()->route('verify')->with(['numero_telefone' => $telefone]);
    }
}