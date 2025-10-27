<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(LoginRequest $request){
        if(Auth::attempt(['username' => $request->username , 'password' => $request->password])){

           return redirect()->intended('/');
        }else{
            return back()->withErrors([
                'error' => 'Invalid email or password'
            ]);
        }

    }
}
