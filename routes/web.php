<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\JazzCashController;
use App\Http\Controllers\RazorPayController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FlutterWaveController;
use App\Http\Controllers\ImportExportController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('charge',[PaymentController::class,'charge'])->name('charge');
Route::get('/',[PaymentController::class,'index'])->name('payment');
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


