<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;
use App\Models\User;
use DateTime;

use App\Models\Member_donation;
use Auth;
class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }


    public function profile_update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:250',
            'profile_image' => 'nullable|max:250',
            'email' => [
                    'required',
                    Rule::unique('users', 'email')->ignore(Auth::user()->id),
                ],
            'phone' => [
                    'nullable',
                    Rule::unique('members', 'phone')->ignore(Auth::user()->member->id),
                ],
            'date_of_birth' => ['nullable'],
            'father_name' => ['nullable', 'string','max:255'],
            'mother_name' => ['nullable', 'string','max:255'],
            'batch' => ['nullable', 'string','max:255'],
            'session' => ['nullable', 'string','max:255'],
            'faculty' => ['nullable', 'string','max:255'],
            'department' => ['nullable', 'string','max:255'],
            'uk_address' => ['required', 'string','max:255'],
            'uk_post_code' => ['required', 'string','max:255'],
            'bangladesh_address' => ['required', 'string','max:255'],
        ]);
        
        DB::beginTransaction(); //transaction start

        $profile_image = $request->old_profile_image;
        if(request()->hasFile('profile_image') ){

            if ($request->old_profile_image) {
                if (file_exists('storage/'.$request->old_profile_image)) {
                    unlink('storage/'.$request->old_profile_image);
                }
            }

            // Get filename with the extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            $filenameWithExt = str_replace(' ', '', $filenameWithExt);
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $profile_image= 'members-images/'.str_replace(' ', '-', strtolower($request->name)).'-'.time().'.'.$extension;
            // Upload profile_image
            $path = $request->file('profile_image')->storeAs('public', $profile_image);
        }

        $member = Member::where('id', Auth::user()->member->id)->first();
        $member->profile_image = $profile_image;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->date_of_birth = $request->date_of_birth;
        $member->father_name = $request->father_name;
        $member->mother_name = $request->mother_name;
        $member->batch = $request->batch;
        $member->session = $request->session;
        $member->faculty = $request->faculty;
        $member->department = $request->department;
        $member->uk_address = $request->uk_address;
        $member->uk_post_code = $request->uk_post_code;
        $member->bangladesh_address = $request->bangladesh_address;
        $member->slug = $request->name == $member->name ? $member->slug : str_replace(' ', '-', strtolower($request->name));
        $member->save();

        $data = User::where('id', Auth::user()->id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        DB::commit(); //transaction end
        
        if ($data) {
            return redirect()->back()->with('success','Data Updated Successfully');
        }else{
            return redirect()->back()->with('error','Upps!! Something Error.');
        }
    }

    public function password_update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['required','same:new_password'],
        ]);
   
        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->back()->with('success','Password Updated Successfully');
    }

    public function donate(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|max:255',
            'account_name' => 'required|max:255',
            'account_number' => 'required|max:255',
            'payment_date' => ['required'],
            'amount' => 'required|numeric',
        ]);

        $data = new Member_donation;
        $data->member_id = Auth::user()->member->id;
        $data->bank_name = $request->bank_name;
        $data->account_name = $request->account_name;
        $data->account_number = $request->account_number;
        $data->payment_date = $request->payment_date;
        $data->amount = $request->amount;
        $data->save();

        if ($data) {
            return redirect()->back()->with('success','Data Inserted Successfully');
        }else{
            return redirect()->back()->with('error','Upps!! Something Error.');
        }
    }
}