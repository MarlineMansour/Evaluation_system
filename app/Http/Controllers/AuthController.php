<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Runner\validate;

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


    public function getView(){
        return view('user.changePassword');
    }

    public function storePassword(ChangePasswordRequest $request){


        $user=Auth::user();

        if (!Hash::check($request->oldpassword, $user->password)) {

            toast('error', 'Your old password is incorrect!');
            return back();
        }
        if( $request->newpassword != $request->confirmPassword){


            toast('error', ' New password and Confirm password do not match');
            return back();
        }

        User::where('id',$user->id)->update(['password'=> Hash::make($request->newpassword), 'updated_by'=>$user->id]);
        toast('success', 'Password changed successfully! Please log in again.');

        Auth::logout();
        return redirect()->route('login');
    }
}
