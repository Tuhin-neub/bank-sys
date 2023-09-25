<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

//-----------------------------admin forget password START----------------------------
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [AdminAuthController::class, 'admin_login'])->name('admin-login');
Route::post('/admin-login-check', [AdminAuthController::class, 'admin_login_check'])->name('admin-login-check');
Route::get('/admin/password/reset', [AdminAuthController::class, 'admin_password_reset'])->name('admin-password-reset');
Route::post('/admin/password/forgot',[AdminAuthController::class,'sendResetLink'])->name('admin.forgot.password.link');
Route::get('/admin/password/reset/{token}',[AdminAuthController::class,'showResetForm'])->name('admin.reset.password.form');
Route::post('/admin/password/reset',[AdminAuthController::class,'resetPassword'])->name('admin.reset.password');
//-----------------------------admin forget password END----------------------------


//-----------------------------user forget password START----------------------------
Route::get('/forget-password','ForgetPasswordController@forget_password')->name('forget.password');
Route::post('/reset-password-link','ForgetPasswordController@reset_password_link')->name('reset.password.link');
Route::get('/reset-password/{token}','ForgetPasswordController@reset_form')->name('reset.password.form');
Route::post('/password-reset','ForgetPasswordController@reset_password')->name('password.reset');
//-----------------------------user forget password END----------------------------

Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>['auth:admin']], function (){
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

   




});

Route::group(['as'=>'user.','prefix'=>'user','middleware'=>['auth','user']], function (){
    // Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });

    Route::post('/profile-update',[DashboardController::class, 'profile_update'])->name('profile.update');
    Route::post('/password-update',[DashboardController::class, 'password_update'])->name('password.update');
     //--------------user  start---------
     Route::get('/profile', 'UserController@user_profile')->name('profile');
     Route::put('/profile', 'UserController@user_profile_update')->name(
         'profile.update'
     );
     Route::put('change-password', 'UserController@passupdate')->name(
         'change.password'
     );
     Route::get('/transaction', 'UserController@transaction')->name('transaction');
     Route::get('/deposit', 'UserController@deposit')->name('deposit');
     Route::post('/deposit-store', 'UserController@deposit_store')->name('deposit-store');
     Route::get('/withdraw', 'UserController@withdraw')->name('withdraw');
     Route::post('/withdraw-store', 'UserController@withdraw_store')->name('withdraw-store');

     //--------------user  end-----------

});