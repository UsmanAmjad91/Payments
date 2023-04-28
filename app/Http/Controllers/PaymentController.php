<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\DB;
use Omnipay\Common\GatewayFactory;
use Illuminate\Support\Facades\Redirect;
use Mockery\Expectation;
use Toastr;
use App\Models\Payment;


class PaymentController extends Controller
{

    private $gateway;

    public function __construct()
    {

        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
        // set permission
        // $this->middleware('permission:charge|payment|success|error', ['only' => ['index','show','view','list']]);
        // $this->middleware('permission:charge', ['only' => ['create','store']]);
        // $this->middleware('permission:payment', ['only' => ['edit','update']]);
        // $this->middleware('permission:success', ['only' => ['destroy','delete']]);
    }

    /**
     * Call a view.
     */
    public function index()
    {
        return view('payment');
    }

    /**
     * Initiate a payment on PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function charge(Request $request)
    {
        if($request->input('_token'))
        {

            try {

                $response = $this->gateway->purchase(array(
                    'amount' => $request->input('amount'),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('success'),
                    'cancelUrl' => url('error'),
                ));
                $response = $response->send();
                if ($response->redirect()) {
                    $response->redirect();
                } else {
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * Charge a payment and store the transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $payment = new Payment;
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();
                toastr()->success('Payment is successful. Your transaction id is: '. $arr_body['id']);
                return redirect(route('payment'));
            } else {
                toastr()->error('Some Thing Wrong Transaction is declined');
                return $response->getMessage();
            }
        } else {

            toastr()->error('Transaction is declined');
            return redirect(route('payment'));
        }
    }

    /**
     * Error Handling.
     */
    public function error(Request $request)
    {
        toastr()->error('You Have Cancle Payment');
        return redirect(route('payment'));
    }
}
