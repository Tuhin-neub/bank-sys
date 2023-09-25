<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Shop_info;
use App\Models\Self_cash;
use App\Models\EmployeeOtherInfos;
use App\Models\Daily_cash_book;
use App\Models\EmployeeSalaries;
use Illuminate\Support\Facades\DB;
use Auth;
use File;

date_default_timezone_set("Asia/Dhaka");

class AdminController extends Controller
{
    public function index(){
        // $this->update_daily_cash_book(date('Y-m-d'), 0, 0);
        return view('admin.dashboard');
    }


    public function check_url_group(){
        if(Auth::check() && Auth::user()->role_id == 1){
            $url_group = 'superadmin';
        }elseif(Auth::check() && Auth::user()->role_id == 2){
            $url_group = 'admin';
        }elseif(Auth::check() && Auth::user()->role_id == 3){
            $url_group = 'staff';
        }elseif(Auth::check() && Auth::user()->role_id == 4){
            $url_group = 'user';
        }
        return $url_group;
    }

    public function current_balance(){
        $total_expense = Expenses::sum('amount');
        $total_employee_salary = 0;

        return view('admin.pages.cash_management.current_balance', compact('total_expense', 'total_employee_salary'));
    }

    public function balance_transfer(Request $request)
    {
        // return $request->transfer_from;
        $this->validate($request,[
            // 'bill_id' => 'required',
            'transfer_from' => 'required',
            'transfer_to' => 'required',
            'amount' => 'required'
        ]);
        DB::beginTransaction(); //transaction start

        // balance transfer from
        $info = Shop_info::where('id', 1)->first();
        if($request->transfer_from == 'Cash' && $request->amount <= $info->cash_amount){
            $info->cash_amount = $info->cash_amount - $request->amount;
        }else if($request->transfer_from == 'Bkash' && $request->amount <= $info->bkash_amount){
            $info->bkash_amount = $info->bkash_amount - $request->amount;
        }else if($request->transfer_from == 'Bank' && $request->amount <= $info->bank_amount){
            $info->bank_amount = $info->bank_amount - $request->amount;
        }else if($request->transfer_from == 'Nagad' && $request->amount <= $info->nagad_amount){
            $info->nagad_amount = $info->nagad_amount - $request->amount;
        }else if($request->transfer_from == 'Rocket' && $request->amount <= $info->rocket_amount){
            $info->rocket_amount = $info->rocket_amount - $request->amount;
        }
        else{
            return redirect()->back()->withErrors(['errormsg' => 'No enough balance to transfer..!!']);
        }

        // balance transfer to
        if($request->transfer_to == 'Cash'){
            $info->cash_amount = $info->cash_amount + $request->amount;
        }else if($request->transfer_to == 'Bkash'){
            $info->bkash_amount = $info->bkash_amount + $request->amount;
        }else if($request->transfer_to == 'Bank'){
            $info->bank_amount = $info->bank_amount + $request->amount;
        }else if($request->transfer_to == 'Nagad'){
            $info->nagad_amount = $info->nagad_amount + $request->amount;
        }else if($request->transfer_to == 'Rocket'){
            $info->rocket_amount = $info->rocket_amount + $request->amount;
        }
        $info->save();
        
        $save_data = new Self_cash();
        $save_data->reference = $request->transfer_from.' To '.$request->transfer_to;
        $save_data->amount = $request->amount;
        $save_data->reference_id = 0;
        $save_data->status = 2;
        $save_data->save();

        $save_data = new Self_cash();
        $save_data->reference = $request->transfer_to.' From '.$request->transfer_from;
        $save_data->amount = $request->amount;
        $save_data->reference_id = 0;
        $save_data->status = 1;
        $save_data->save();

        DB::commit(); //transaction end

        return redirect()->back()->with('success', 'Transfer successfully');
    }

    public function update_daily_cash_book($date, $income, $expense){
        $last_update = Daily_cash_book::latest('id')->first();
        if (!empty($last_update)) {
            $last_date = $last_update->created_at->format("Y-m-d");
        }else{
            $last_date = date("Y-m-d");
        }
        // $last_date ='2021-09-30';
        // days difference
        $start = new DateTime(date('Y-m-d'));
        $end = new DateTime($last_date);
        $days = $start->diff($end);
        $difference = $days->format('%a');

        DB::beginTransaction(); //transaction start
        for ($i = 1; $i<=$difference; $i++){
            $last_date = date("Y-m-d", strtotime("$last_date +1 days"));

            $total_income = 0; 
            $total_expense = 0;

            $check_cash = Daily_cash_book::whereDate('created_at', '=', $last_date)->first();
            if (empty($check_cash)) {
                $last_stroe = Daily_cash_book::latest('id')->first();
                if (!empty($last_stroe)) {
                    $start_balance = $last_stroe->start_balance + ($last_stroe->income_amount - $last_stroe->expense_amount);
                }else{
                    $start_balance = 0;
                }

                $cash = new Daily_cash_book;
                $cash->start_balance = $start_balance;
                $cash->income_amount = $total_income;
                $cash->expense_amount = $total_expense;
                $cash->month_year = date("Y-m", strtotime("$last_date"));
                $cash->created_at = date("Y-m-d H:i:s", strtotime("$last_date"));
                $cash->save();
            }
        }

        if ($difference == 0 ) {
            $total_income = $income; 
            $total_expense = $expense;

            $check_cash = Daily_cash_book::whereDate('created_at', '=', $date)->first();
            // dd($check_cash);
            if (!empty($check_cash)) {
                $check_cash->income_amount = $check_cash->income_amount + $total_income;
                $check_cash->expense_amount = $check_cash->expense_amount + $total_expense;
                $check_cash->save();
            }else{
                $last_stroe = Daily_cash_book::latest('id')->first();
                if (!empty($last_stroe)) {
                    $start_balance = $last_stroe->start_balance + ($last_stroe->income_amount - $last_stroe->expense_amount);
                }else{
                    $start_balance = 0;
                }
                
                $cash = new Daily_cash_book;
                $cash->start_balance = $start_balance;
                $cash->income_amount = $total_income;
                $cash->expense_amount = $total_expense;
                $cash->month_year = date("Y-m", strtotime("$date"));
                $cash->save();
            }
        }
        DB::commit(); //transaction end
        return true;
    }

    public function update_shop_balance($amount, $reference, $status, $reference_id, $method){
        DB::beginTransaction(); //transaction start
        $info = Shop_info::where('id', 1)->first();
        if($method == 'Cash'){
            $info->cash_amount = $info->cash_amount + $amount;
        }else if($method == 'Bkash'){
            $info->bkash_amount = $info->bkash_amount + $amount;
        }else if($method == 'Bank'){
            $info->bank_amount = $info->bank_amount + $amount;
        }else if($method == 'Nagad'){
            $info->nagad_amount = $info->nagad_amount + $amount;
        }else if($method == 'Rocket'){
            $info->rocket_amount = $info->rocket_amount + $amount;
        }
        $info->balance = $info->balance + $amount;
        $info->save();

        $save_data = new Self_cash();
        $save_data->reference = $reference;
        $save_data->amount = abs($amount);
        $save_data->status = $status;
        $save_data->reference_id = $reference_id;
        $save_data->save();
        DB::commit(); //transaction end

        return true;
    }

    public function change_shop_balance($amount, $previous_amount, $status, $reference, $reference_id, $method, $previous_method){

        // dd($amount .'-'. $previous_amount .'-'. $status .'-'. $reference .'-'. $reference_id .'-'. $method .'-'. $previous_method);
        DB::beginTransaction(); //transaction start
        $info = Shop_info::where('id', 1)->first();
        // change previous amount
        if($previous_method == 'Cash'){
            $info->cash_amount = $info->cash_amount - $previous_amount;
        }else if($previous_method == 'Bkash'){
            $info->bkash_amount = $info->bkash_amount - $previous_amount;
        }else if($previous_method == 'Bank'){
            $info->bank_amount = $info->bank_amount - $previous_amount;
        }else if($previous_method == 'Nagad'){
            $info->nagad_amount = $info->nagad_amount - $previous_amount;
        }else if($previous_method == 'Rocket'){
            $info->rocket_amount = $info->rocket_amount - $previous_amount;
        }
        $info->balance = $info->balance - $previous_amount;
        $info->save();

        // update current amount
        $info = Shop_info::where('id', 1)->first();
        if($method == 'Cash'){
            $info->cash_amount = $info->cash_amount + $amount;
        }else if($method == 'Bkash'){
            $info->bkash_amount = $info->bkash_amount + $amount;
        }else if($method == 'Bank'){
            $info->bank_amount = $info->bank_amount + $amount;
        }else if($method == 'Nagad'){
            $info->nagad_amount = $info->nagad_amount + $amount;
        }else if($method == 'Rocket'){
            $info->rocket_amount = $info->rocket_amount + $amount;
        }
        $info->balance = $info->balance + $amount;
        $info->save();

        $save_data = Self_cash::where('status', $status)->where('reference_id', $reference_id)->first();
        $save_data->reference = $reference;
        $save_data->amount = abs($amount);
        $save_data->save();
        DB::commit(); //transaction end

        return true;
    }
    
}
