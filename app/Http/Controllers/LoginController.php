<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use App\Models\User;

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

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        session()->put('usuario', $user);

        Auth::login($user);

        return $this->authenticated($request, $user);
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