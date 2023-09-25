<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \App\Mail\ForgetPasswordMail;
use App\Models\User;
use App\Models\Member;

class ForgetPasswordController extends Controller
{
    public function forget_password()
    {
        return view('website.auth.forget-password');
    }

    public function reset_password_link(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|exists:users,email',
        ]);
        
        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$token,
              'created_at'=>Carbon::now(),
        ]);

        $action_link = route('reset.password.form',['token'=>$token,'email'=>$request->email]);
        $body = "We received a request to reset your password for <b>BHAUK </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

        $member_info = Member::where('email', $request->email)->first();
        $name = $member_info->name;

        $data = [
            'action_link' => $action_link,
            'body' => $body,
            'member_info' => $member_info,
            'website_name' => 'BHAUK',
            'website_link' => 'https://bhauk.uk',
            'website_logo' => 'https://bhauk.uk/all/website/assets/images/logo.png',
            'subject' => 'Reset Password',
        ];
        Mail::to($request->email)->send(new ForgetPasswordMail($data));

       return back()->with('success', 'We have emailed your password reset link. Check Your!');
    }

    public function reset_form(Request $request, $token = null){
        return view('website.auth.reset-password')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function reset_password(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid token');
        }else{

            User::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('login')->with('success', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
    
}
