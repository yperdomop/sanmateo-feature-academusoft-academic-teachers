<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $input = $request->all();

        if(!auth()->attempt(array('USUA_USUARIO'=>$input['username'], 'password'=>$input['password']))){
            return response(['message'=> 'Invalid credentialss']);
        }
        try{
            $user = Auth::user();
            $accessToken = $user->createToken('authToken')->accessToken;
            return response(['user' => $user, 'access_token' => $accessToken]);
        }catch(Exception $ex){
            return response(['message'=>$ex->getMessage()]);
        }
    }
}
