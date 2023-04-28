<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Omnipay\Common\GatewayFactory;
use Illuminate\Support\Facades\Redirect;
use Mockery\Expectation;
use Toastr;
use App\Models\StripePayments;
use Stripe;


class StripeController extends Controller
{
    public function __construct()
    {
        // set permission
        $this->middleware('permission:stripe-post', ['only' => ['index','show','view','list']]);
        $this->middleware('permission:stripe-post', ['only' => ['create','store']]);
        $this->middleware('permission:stripe-post', ['only' => ['edit','update']]);
        $this->middleware('permission:stripe-post', ['only' => ['destroy','delete']]);
    }

    public function stripePost(Request $request)
    {
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $response  = Stripe\Charge::create ([
                "amount" => $request->amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Usman."
        ]);
        if($response->source->id){
   // Insert transaction data into the database
//    $payment = new StripePayments;
//    $payment->user_id = 1;
//    $payment->description =$request->description;
//    $payment->user_email =  $request->user_email;
//    $payment->token= $request->stripeToken;
//    $payment->amount = $request->amount;
//    $payment->currency = $request->currency;
//    $payment->payment_status =$request->payment_status;
//    $payment->save();
        }
        toastr()->success('You have successfully Payment');
        return redirect(route('payment'));
    }
}
