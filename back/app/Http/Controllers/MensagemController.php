<?php

namespace App\Http\Controllers;

use App\Events\UserPresenceEvent;
use App\User;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;
use App\Mensagem;
use App\Events\MensagemEvent;
class MensagemController extends Controller
{
    public function index(Request $request){
        if($request->getMethod() == 'GET'){
            return view('form');
        }
        if($request->getMethod() == 'POST'){
            $data = $request->all();
            $m = new Mensagem($data);
            $m->save();
            $user = (new User)->newQuery()->find($data['user']);
            $e = new MensagemEvent($m, $user);
            event($e);
            return ['success'=>true];
        }
    }

    public function fakeLogin(){
        Auth::loginUsingId(2);
        $user  = Auth::user();
        broadcast(new UserPresenceEvent($user));
    }
    public function fakeToken(Request $request){
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
