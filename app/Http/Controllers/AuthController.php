<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(){
        return view('login');
    }

    public function loginUser(LoginRequest $request){
        if(Auth::attempt(['username' => $request->username , 'password' => $request->password])){
           return redirect()->intended('/');
        }else{
            return view('login' , ['error' => ' Invalid username or password']);
        }

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
