<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthUserController extends Controller
{
    public function login(){
        $data['header_title'] = 'Login';
        return view('auth.login_user', $data);
    }

    public function login_user(Request $request){
        $remember = !empty($request->remember) ? true : false;
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('user.dashbaord');
        } else {
            Log::error('Login failed', ['email' => $request->email]);
            return redirect()->route('user.login')->with('error', 'Please enter the correct account');
        }
    }

    public function register(){
        $data['header_title'] = 'Register';
        return view('auth.register_user', $data);
    }

    public function register_user(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.login');
    }

    public function logout_user(){
        Auth::guard('web')->logout();
        return redirect()->route('user.dashbaord');
    }
}
