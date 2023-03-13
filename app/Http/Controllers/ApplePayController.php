<?php

namespace App\Http\Controllers;

use App\Models\ApplePay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mockery\Expectation;
use Toastr;
use App\Models\StripePayments;
use Stripe;

class ApplePayController extends Controller
{
   
    public function index(Request $request)
    {
        //
    }
    public function pay(Request $request)
    {
        //
    }
    
}
