<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (Request $request){
    //    if(Auth::attempt($request->only('email', 'password'))){

    //         return response()->json([
    //             "status" => "success",
    //             "message" => "Authorized",
    //             'user' => Auth::user()], 200);  deste jeito envia todo o objeto usuário
    //    }

       if(Auth::attempt($request->only('email', 'password'))){

        if(Auth::user()->tipo == 'P'){
            $token = $request->user()->createToken('clinicavue',['can-pacientes']);
        }else{
            $token = $request->user()->createToken('clinicavue', ['can-all']);
        }

        return response()->json([
            "status" => "success",
            "message" => "Authorized",
            'user' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'tipo' => Auth::user()->tipo,
                'token' => [
                    'expires_at' => $token->accessToken['expires_at'],
                    'token' => $token->plainTextToken]
                ]
            ], 200);
   }
        return response()->json([
            "status" => "error",
            "message" => "Not Authorized"], 403);
    }
}
