<?php

namespace App\Http\Controllers;

use App\Models\JazzCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mockery\Expectation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class JazzCashController extends Controller
{
   
    public function index(Request $request)
    {
        // dd($request->all());
        // $jazzcash = new JazzCash();
        // $jazzcash->setAmount($request->amount);
        // $jazzcash->setBillReference($request->billref);
        // $jazzcash->setProductDescription($request->productDescription);

        // $jazzcash = new JazzCash();
        // $jazzcash->setAmount(1000); // last 2 digits will be considered as decimals.
        // $jazzcash->setBillReference('bill123');
        // $jazzcash->setProductDescription('Test product');
        // $response = $jazzcash->sendRequest();

        // return $response;	
	
		$post_data =  array(
			"pp_Version" 			=> Config::get('constants.jazzcash.VERSION'),
			"pp_TxnType" 			=> "MWALLET",
			"pp_Language" 			=> Config::get('constants.jazzcash.LANGUAGE'),
			"pp_MerchantID" 		=> Config::get('constants.jazzcash.MERCHANT_ID'),
			"pp_SubMerchantID" 		=> "",
			"pp_Password" 			=> Config::get('constants.jazzcash.PASSWORD'),
			"pp_BankID" 			=> "TBANK",
			"pp_ProductID" 			=> "RETL",
			"pp_TxnRefNo" 			=> "r4gr84g4gr",
			"pp_Amount" 			=> 100,
			"pp_TxnCurrency" 		=> Config::get('constants.jazzcash.CURRENCY_CODE'),
			"pp_TxnDateTime" 		=> "",
			"pp_BillReference" 		=> "billRef",
			"pp_Description" 		=> "Description of transaction",
			"pp_TxnExpiryDateTime" 	=> "",
			"pp_ReturnURL" 			=> Config::get('constants.jazzcash.RETURN_URL'),
			"pp_SecureHash" 		=> "",
			"ppmpf_1" 				=> "1",
			"ppmpf_2" 				=> "2",
			"ppmpf_3" 				=> "3",
			"ppmpf_4" 				=> "4",
			"ppmpf_5" 				=> "5",
		);
		
		$pp_SecureHash = $this->get_SecureHash($post_data);
		
		$post_data['pp_SecureHash'] = $pp_SecureHash;
		
		Session::put('post_data',$post_data);
		echo '<pre>';
		print_r($post_data);
		echo '</pre>';
        toastr()->info("");
        return redirect(route('payment'));
		
		
	}
	
	private function get_SecureHash($data_array)
	{
		
		
		$str = Config::get('constants.jazzcash.INTEGERITY_SALT')."4848jy48h8";
		
		$pp_SecureHash = hash_hmac('sha256', $str, Config::get('constants.jazzcash.INTEGERITY_SALT'));
		
		//echo '<pre>';
		//print_r($data_array);
		//echo '</pre>';
		
		return $pp_SecureHash;
	}
	
	
	public function paymentStatus(Request $request)
	{
		$response = $request->input();
		echo '<pre>';
		print_r($response);
		echo '</pre>';
		
		if($response['pp_ResponseCode'] == '000')
		{
			$response['pp_ResponseMessage'] = 'Your Payment has been Successful';
		}
		
		
        toastr()->info($response);
        return redirect(route('payment'));
	}


    }

   

