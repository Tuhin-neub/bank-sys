<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\ExecutiveMember;
use App\Models\OurProject;
use App\Models\TrainingMembership;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Donation;

class AdminAuthController extends Controller
{
    public function admin_login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()
                ->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [

            'Active_project' => OurProject::where('project_type', Null)->where('status', 1)->count(),
            'inactive_project' => OurProject::where('project_type', Null)->where('status', 0)->count(),
            'Active_appeal' => OurProject::where('project_type', 'appeal')->where('status', 1)->count(),
            'donation' => Donation::where('payment_status', 1)->where('status', 1)->count(),
            'executive_member' => ExecutiveMember::where('status', 1)->count(),
            'user' => User::where('status', 1)->count(),
            'pending_volunteer' => Volunteer::where('status', 0)->count(),
            'approved_volunteer' => Volunteer::where('status', 1)->count(),
            'rejected_volunteer' => Volunteer::where('status', 2)->count(),
        ]);
    }
    public function admin_login_check(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 
           'password' => $request->password], $request->get('remember'))) {
            return redirect()
                ->route('admin.dashboard');
        }
        return redirect()->
            back()->
            withInput($request->only('email', 'remember'))
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }

    public function admin_password_reset()
    {
        return view('admin.auth.password-reset-email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:admins,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$token,
              'created_at'=>Carbon::now(),
        ]);
        
        $action_link = route('admin.reset.password.form',['token'=>$token,'email'=>$request->email]);
        $body = "We are received a request to reset the password for <b>Your app Name </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

       \Mail::send('admin.auth.email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
             $message->from('noreply@example.com','Your App Name');
             $message->to($request->email,'Your name')
                     ->subject('Reset Password');
       });

       return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetForm(Request $request, $token = null){
        return view('admin.auth.reset')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins,email',
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

            Admin::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('admin-login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
}