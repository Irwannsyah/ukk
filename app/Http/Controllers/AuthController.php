<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function login()
    {
        if ( Auth::guard('admin')->check()) {
            return view('admin.dashboard');
        } else {
            return view('admin.auth.login');
        }
    }

    public function register(){
        return view('admin.auth.register');
    }

    public function admin_auth_login(Request $request){
        $remember = !empty($request->remember) ? true : false;
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,], $remember)){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with('error', 'Please enter the correct account');
        }
    }

    public function admin_auth_register(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin_login');
    }



    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_auth_login');
    }
}
