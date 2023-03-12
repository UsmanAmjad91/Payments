<?php

namespace App\Http\Controllers;

use App\Models\FlutterWave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Stephenjude\PaymentGateway\PaymentGateway;
use Stephenjude\PaymentGateway\DataObjects\PaymentData;

class FlutterWaveController extends Controller
{
   
    public function index(Request $request)
    {
        // dd($request->all());
        $provider = PaymentGateway::make('flutterwave');
        $paymentSession = $provider->initializePayment([
                        'currency' => 'NGN', // required
                        'amount' => $request->amount, // required
                        'email' => $request->email, // required
                        'meta' => [ 'name' => $request->username, 'phone' => $request->phone],
                        'closure' => function (PaymentData $payment){
                            /* 
                             * Payment verification happens immediately after the customer makes payment. 
                             * The payment data gotten from the verification will be injected into this closure.
                             */
                            logger('payment details', [
                               'currency' => $payment->currency, 
                               'amount' => $payment->amount, 
                               'status' => $payment->status,
                               'reference' => $payment->reference,   
                               'provider' => $payment->provider,   
                               'date' => $payment->date,                   
                            ]);
                        },
                    ]);
        
        $paymentSession->provider;
        $paymentSession->checkoutUrl;
        $paymentSession->expires;

        dd($paymentSession);
    }

    
}
