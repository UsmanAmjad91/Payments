<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\JazzCashController;
use App\Http\Controllers\RazorPayController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FlutterWaveController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
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
#Social Login
//Google
Route::get('/login/google', [AuthUserController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthUserController::class, 'handleGoogleCallback']);
//Facebook
Route::get('/login/facebook', [AuthUserController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [AuthUserController::class, 'handleFacebookCallback']);
//Github
Route::get('/login/github', [AuthUserController::class, 'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback', [AuthUserController::class, 'handleGithubCallback']);
// Route::get('/', function () { authuser
//     return view('welcome');
// });
Route::get('/',[AuthUserController::class,'login'])->name('auth.login');
Route::post('/login',[AuthUserController::class,'sign_in'])->name('auth.sign_in');
Route::post('register',[AuthUserController::class,'register'])->name('auth.register.user');

#Auth User
Route::group(['middleware' => 'authuser'], function () {
#Users
Route::get('/user/list',[UserController::class,'show'])->name('users.show');
Route::get('/user/add',[UserController::class,'add'])->name('users.add');
Route::post('/user/create',[UserController::class,'create'])->name('users.create');
Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('users.edit');
Route::post('/user/update/{id}',[UserController::class,'update'])->name('users.update');
Route::get('/user/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');
#Auth Logout
Route::get('/users/auth/logout', [UserController::class, 'logout'])->name('logout.user');
#Permissions
Route::get('/permissions/list',[PermissionController::class,'index'])->name('permission.show');
Route::get('/permissions/add',[PermissionController::class,'add'])->name('permission.add');
Route::post('/permissions/add',[PermissionController::class,'create'])->name('permission.create');
Route::get('/permissions/edit/{id}',[PermissionController::class,'edit'])->name('permission.edit');
Route::post('/permissions/update/{id}',[PermissionController::class,'update'])->name('permission.update');
Route::get('/permissions/destroy/{id}',[PermissionController::class,'destroy'])->name('permission.destroy');
#Roles
Route::get('/roles/list',[RoleController::class,'index'])->name('role.show');
Route::get('/roles/add',[RoleController::class,'add'])->name('role.add');
Route::post('/roles/add',[RoleController::class,'create'])->name('role.create');
Route::get('/roles/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::post('/roles/update/{id}',[RoleController::class,'update'])->name('role.update');
Route::get('/roles/destroy/{id}',[RoleController::class,'destroy'])->name('role.destroy');
#Paypal
Route::post('charge',[PaymentController::class,'charge'])->name('charge');
Route::get('home',[PaymentController::class,'index'])->name('payment');
Route::get('success',[PaymentController::class,'success'])->name('success');
Route::get('error',[PaymentController::class,'error'])->name('error');

//Stripe //
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

//JazzCash
Route::Post('jazzCash', [JazzCashController::class, 'index'])->name('jazzCash');

//razorpay
Route::post('razorpay', [RazorpayController::class, 'index'])->name('razorpay');

//flutterwave
Route::post('flutterwave', [FlutterWaveController::class, 'index'])->name('flutter_wave');

// Email Send //
Route::get('email/view',[EmailController::class,'index'])->name('email.view');
Route::post('email/send',[EmailController::class,'email'])->name('email.send');
Route::get('email/temp',[EmailController::class,'template'])->name('email.temp');

//Import Export data//

Route::get('import_export',[ImportExportController::class,'index'])->name('import.export');
Route::post('import',[ImportExportController::class,'import'])->name('import');
Route::get('export',[ImportExportController::class,'export'])->name('export');

Route::get('pdf',[ImportExportController::class,'pdf'])->name('pdf');
});

