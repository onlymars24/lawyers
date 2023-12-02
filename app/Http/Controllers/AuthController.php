<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        if(!Auth::attempt($request->all())){
            return response(['message' => 'Неверный логин или пароль!'], 422);
        }

        $token = Auth::user()->createToken('authToken')->accessToken;

        return response([
            'token' => $token
        ]);
    }
}