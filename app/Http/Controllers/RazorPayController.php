<?php

namespace App\Http\Controllers;

use App\Models\RazorPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use Session;
use Redirect;
use Mockery\Expectation;
use Toastr;
use App\Models\StripePayments;
class RazorPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();        
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

                
            } 
            catch (\Exception $e) 
            { 
                toastr()->error($e);
                return redirect(route('payment'));
            }            
        }
        
        toastr()->success('Payment successful, your order will be despatched in the next 48 hours.');
        return redirect(route('payment'));
    }


    }

    

