<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserMoreInfo;
use App\Models\Transaction;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use File;
use PHPUnit\Runner\AfterLastTestHook;

class UserController extends Controller
{
    public function dashboard()
    {
        
        return view('user.dashboard', [
            'datas' => Transaction::all(),
            'total_balance' => User::where('id', Auth::user()->id)->sum('balance'),
            'total_deposit' => Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 1)->sum('amount'),
            'total_withdraw' => Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 2)->sum('amount'),
        ]);
    }
    
    public function user_profile()
    {
        $data = User::with('user_more_info')
            ->where('id', Auth::user()->id)
            ->first();
        //$user_mores = UserMoreInfo::all();
        return view('user.pages.user-profile', compact('data'));
    }

    public function user_profile_update(Request $request)
    {
        $validated = $request->validate([
            // 'image'=>'required|file|image|dimensions:max_width=300,max_height=250',
            'avatar' => 'nullable',
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(Auth::user()->id),
            ],
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $avatar = $request->old_avatar;
        if (request()->hasFile('avatar')) {
            //old image delete after updating
            File::delete(public_path('storage/' . $request->old_avatar));
            // Get filename with the extension
            $filenameWithExt = $request
                ->file('avatar')
                ->getClientOriginalName();
            $filenameWithExt = str_replace(' ', '', $filenameWithExt);
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request
                ->file('avatar')
                ->getClientOriginalExtension();
            // Filename to store
            $avatar =
                'user-profile/' . $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request
                ->file('avatar')
                ->storeAs('public', $avatar);
        }

        $user_info = UserMoreInfo::where('user_id', Auth::user()->id)->first();
        if (empty($user_info)) {
            $user_info = new UserMoreInfo();
            $user_info->user_id = $user->id;
        }
        $user_info->avatar = $avatar;
        $user_info->save();
        if ($user_info) {
            return redirect()
                ->back()
                ->with('success', 'Data Updated Successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Upps!! Something Error.');
        }
    }

    public function passupdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            new MatchOldPassword(),
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $data = User::find(Auth::user()->id);
        if (!Hash::check($request->get('old_password'), $data->password)) {
            // The passwords matches
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Your current password does not matches with the password you provided. Please try again.'
                );
        }
        $data->password = Hash::make($request->password);
        $data->save();
        if ($data) {
            return redirect()
                ->back()
                ->with('success', 'Password Updated Successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Upps!! Something Error.');
        }
    }

    public function transaction()
    {
        $datas = Transaction::all();
        return view('user.pages.transaction',compact('datas'));
    }
    public function deposit()
    {
        $datas = Transaction::where('transaction_type', 1)->latest()->get();
        return view('user.pages.deposit',compact('datas'));
    }
    public function withdraw()
    {
        $datas = Transaction::where('transaction_type', 2)->latest()->get();
        return view('user.pages.withdraw',compact('datas'));
    }


    public function deposit_store(Request $request)
    {
        $this->validate($request,[
            'amount' => ['required'],
        ]);

       
        DB::beginTransaction(); //transaction start
        $user = User::where('id', Auth::user()->id)->first(); 
        $user->balance = $user->balance - $request->amount;
        $user->save();
        
        $data = new Transaction();
        $data->amount = $request->amount;
        $data->transaction_type = 1;
        $data->user_id = Auth::user()->id ;
        $data->date = date('Y-m-d');
        $data->save();
        DB::commit(); //transaction end

        if ($data) {
            return redirect()->back()->with('success','Deposit Successfully');
        }else{
            return redirect()->back()->with('error','Upps!! Something Error.');
        }
    }

    public function withdraw_store(Request $request)
    {
        $this->validate($request,[
            'amount' => ['required'],
        ]);

       
        DB::beginTransaction(); //transaction start
        $user = User::where('id', Auth::user()->id)->first();
        $accountType = Auth::user()->account_type;
        $amount = $request->amount;

        
        if ($accountType == 1) {
            $feePercentage = 0.015; 
        } elseif ($accountType == 2) {
            $totalWithdrawalAmount = Transaction::where('user_id', Auth::user()->id)->sum('amount');

            if ($totalWithdrawalAmount <= 50000) {
                $feePercentage = 0.025; 
            } else {
                $feePercentage = 0.015; 
            }
        } else {
            $feePercentage = 0; 
        }

       
        $isFriday = (date('N') == 5); 
        $first1000Withdrawals = Transaction::where('user_id', Auth::user()->id)->where('date', 'LIKE', date('Y-m-d') . '%')->count() < 1000;
        $first5KWithdrawals = Transaction::where('user_id', Auth::user()->id)->where('date', 'LIKE', date('Y-m') . '%')->sum('amount') < 5000;

        if ($isFriday || $first1000Withdrawals || $first5KWithdrawals) {
            $feePercentage = 0; 
        }

       
        $fee = ($feePercentage / 100) * $amount;
        $user->balance = $user->balance - ($amount + $fee);
        $user->save();

       
        $data = new Transaction();
        $data->amount = $amount;
        $data->transaction_type = 2;
        $data->user_id = Auth::user()->id;
        $data->date = date('Y-m-d');
        $data->fee = $fee; 
        $data->save();

        DB::commit(); //transaction end

        if ($data) {
            return redirect()->back()->with('success','Withdraw Successfully');
        }else{
            return redirect()->back()->with('error','Upps!! Something Error.');
        }
    }
    
    
    
    

}