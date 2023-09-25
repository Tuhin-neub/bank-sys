<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Shop_info;
use App\Models\Member_donation;
use App\Models\Member;
use App\Models\OurProject;
use Carbon\Carbon;
use PHPUnit\Framework\OutputError;

function shop_info()
{
    $info = Shop_info::where('id', 1)->first();
    return $info;
}
function projects()
{
    $projects = OurProject::where('project_status', 1)->where('status', 1)->latest()->take(6)->get();
    return $projects;
}

function url_group()
{
    $url_group = '';
    if (Auth::guard('admin')->user()->role_id == 1) {
        $url_group = 'superadmin';
    }
    elseif (Auth::guard('admin')->user()->role_id == 2) {
        $url_group = 'admin';
    }
    elseif (Auth::guard('admin')->user()->role_id == 3) {
        $url_group = 'subadmin';
    }
    return $url_group;
}

function statistic_graph_donation($month)
{
    $data = Member_donation::whereMonth('created_at', $month)->where( DB::raw('YEAR(created_at)'), '=', date('Y'))->sum('amount');
    return $data;
}

function statistic_graph_registration($month)
{
    $data = Member::whereMonth('created_at', $month)->where( DB::raw('YEAR(created_at)'), '=', date('Y'))->sum('registration_fee');
    return $data;
}