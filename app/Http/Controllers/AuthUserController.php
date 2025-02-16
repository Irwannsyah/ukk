<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use DB;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        session()->flush();
        return redirect()->route('user.dashbaord');
    }

    public function forgotPassword(){
        return view('auth.forgot_password');
    }

    public function processForgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if($validator->fails()) {
            return redirect()->route('user.forgotPassword')->withInput()->with('error', 'Akun tidak valid');
        }

        $Token = Str::random(60);

        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $Token,
            'created_at' => now(),
        ]);

        // send email
        $user = User::where('email', $request->email)->first();

        $formData = [
            'token' => $Token,
            'user' => $user,
            'mailSubject' => 'You Have requested reset password'
        ];
        Mail::to($request->email)->send(new ResetPasswordEmail($formData));
        return redirect()->route('user.forgotPassword')->with('success', 'Silahkkan cek email anda untuk mereset password');
    }

    public function resetPassword($token){
         $tokenExist = \DB::table('password_reset_tokens')->where('token', $token)->first();

        if($tokenExist == null){
            return redirect()->route('user.forgotPassword')->with('error', 'Invalid Request');
        }
        return view('auth.resetpassword', [
            'token' => $token
        ]); 
    }

    public function processResetPassword(Request $request){
        $token = $request->token;

        $tokenObj = \DB::table('password_reset_tokens')->where('token', $token)->first();

        if ($tokenObj == null) {
            return redirect()->route('user.forgotPassword')->with('error', 'Invalid Request');
        }
        
        $user = User::where('email', $tokenObj->email)->first();
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.resetPassword', $token)->withErrors($validator);
        }

        User::Where('id', $user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        \DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        return redirect()->route('user.login')->with('success', 'success reset password');
    }
}
