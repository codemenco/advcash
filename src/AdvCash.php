<?php

namespace Codemenco\Advcash;

use Illuminate\Http\Request;
use Config;
use Route;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Codemenco\Advcash\Exceptions\AdvCashException;

use Codemenco\Advcash\Events\AdvCashPaymentIncome;
use Codemenco\Advcash\Events\AdvCashPaymentCancel;

use Codemenco\Advcash\AdvCashInterface;
use Log;
use Codemenco\Advcash\Service\MerchantWebService;
use Codemenco\Advcash\Service\authDTO;
use Codemenco\Advcash\Service\getBalances;
use Codemenco\Advcash\Service\sendMoney;
use Codemenco\Advcash\Service\sendMoneyRequest;
use Codemenco\Advcash\Service\validationSendMoney;
class AdvCash implements AdvCashInterface
{
	use ValidatesRequests;
	protected $memo;
	public function memo($memo){
		$this->memo = $memo;
		return $this;
	}

	public function __construct(){

	}

	protected $merchantWebService;
	protected $arg0;
	public function connect(){
		$this->merchantWebService = new MerchantWebService();
		$this->arg0 = new authDTO();
		$this->arg0->apiName = Config::get('advcash.api_name');
		$this->arg0->accountEmail = Config::get('advcash.account_email');
		$this->arg0->authenticationToken = $this->merchantWebService->getAuthenticationToken(Config::get('advcash.authentication_token'));
	}

	function balance($unit = "USD"){
		$this->connect();
		$getBalances = new getBalances();
		$getBalances->arg0 = $this->arg0;
		try {
		    $getBalancesResponse = $this->merchantWebService->getBalances($getBalances);
		    switch ($unit) {
		    	case 'USD':
		    		$index_of = 0;
		    		break;
		    	
		    	case 'EUR':
		    		$index_of = 1;
		    		break;
		    	
		    	case 'RUR':
		    		$index_of = 2;
		    		break;
		    	
		    	case 'GBP':
		    		$index_of = 3;
		    		break;
		    	
		    	case 'UAH':
		    		$index_of = 4;
		    		break;

		    	case 'KZT':
		    		$index_of = 5;
		    		break;
		    		
		    	case 'BRL':
		    		$index_of = 6;
		    		break;
		    	
		    	default:
		    		throw new \Exception('Currency unit not support');
		    		break;
		    }
		    // return 'string';
		    return number($getBalancesResponse->return[$index_of]->amount);
		} catch (\Exception $e) {
			throw new \Exception($e);
		}
	}

	function form($payment_id, $sum, $units='USD'){
		$sum = number_format($sum, 2, ".", "");
		$arHash = array(
			Config::get('advcash.account_email'),
			Config::get('advcash.ac_sci_name'),
			$sum,
			"USD",
			Config::get('advcash.ac_sci_secret'),
			$payment_id
		);
		$sign = hash('sha256', implode(":", $arHash));

		$form_data = array(
				"ac_account_email"	=>	Config::get('advcash.account_email'),
				"ac_sci_name"		=>	Config::get('advcash.ac_sci_name'),
				"ac_amount"			=>	$sum,
				"ac_currency"		=>	$units,
				"ac_order_id"		=>	$payment_id,
				"ac_sign"			=>	$sign,
				"ac_comments"		=>	$this->memo,
				"operation_id"		=>	$payment_id,
			);
		ob_start();
			echo '<form class="form_payment" id="FORM_pay_ok" action="https://wallet.advcash.com/sci/" method="POST">';
			foreach ($form_data as $key => $value) {
				echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
			}
			echo '<input type="submit" style="width:0;height:0;border:0px; background:none;" class="content__login-submit submit_pay_ok" name="PAYMENT_METHOD" value="">';
			echo '</form>';
		$content = ob_get_contents();
		ob_end_clean();
		// dd($content);
		return $content;
	}

	function validateIPNRequest(Request $request) {
        return $this->check_transaction($request->all(), $request->server(), $request->headers);
    }

    function check_transaction(array $request, array $server, $headers = []){
		Log::info('AdvCash IPN', [
			'request' => $request,
			'headers' => $headers,
			'server'  => array_intersect_key($server, [
				'PHP_AUTH_USER', 'PHP_AUTH_PW'
			])
		]);

		$textReponce = [
			'status' => 'success'
		];

		try{
			$is_complete = $this->validateIPN($request, $server);
			if($is_complete){
				$PassData                     = new \stdClass();
				$PassData->amount             = $request['ac_amount'];
				$PassData->payment_id         = $request['operation_id'];
				$PassData->transaction        = $request['ac_transfer'];
				$PassData->add_info           = [
					"full_data_ipn" => json_encode($request)
				];
				event(new AdvCashPaymentIncome($PassData));
				return \Response::json($textReponce, "200");
			}
		}catch(AdvCashException $e){
			Log::error('AdvCash IPN', [
				'message' => $e->getMessage()
			]);
			$textReponce['status']  = 'faild';
			$textReponce['message'] = $e->getMessage();
			return \Response::json($textReponce, "422");
		}

		return \Response::json($textReponce, "200");
	}

    function validateIPN(array $post_data, array $server_data){
		if(!isset($post_data['ac_hash'])){
			throw new AdvCashException("For validate IPN need ac_hash");
		}

		$arHash = array(
			$post_data["ac_transfer"],
			$post_data["ac_start_date"],
			Config::get('advcash.ac_sci_name'),
			$post_data["ac_src_wallet"],
			Config::get('advcash.ac_dest_wallet'),
			$post_data["ac_order_id"],
			$post_data["ac_amount"],
			$post_data["ac_merchant_currency"],
			Config::get('advcash.ac_sci_secret'),
		);
		$sign = hash('sha256', implode(":", $arHash));

		if($sign !== $post_data['ac_hash']){
			throw new AdvCashException("Hash no valid");
		}

		return true;
	}

	function send_money($payment_id, $amount, $address, $currency){
		$this->connect();
		$amount = number_format($amount, 4, ".", "");

		$arg1 = new sendMoneyRequest();
		$arg1->amount = $amount;
		$arg1->currency = $currency;
		$arg1->email = $address;
		$arg1->note = Config::get('app.name')." ".$payment_id;
		$arg1->savePaymentTemplate = false;

		$validationSendMoney = new validationSendMoney();
		$validationSendMoney->arg0 = $this->arg0;
		$validationSendMoney->arg1 = $arg1;

		$sendMoney = new sendMoney();
		$sendMoney->arg0 = $this->arg0;
		$sendMoney->arg1 = $arg1;

		try {
		    $this->merchantWebService->validationSendMoney($validationSendMoney);
		    $sendMoneyResponse = $this->merchantWebService->sendMoney($sendMoney);

			$PassData              = new \stdClass();
			$PassData->transaction = $sendMoneyResponse->return;
			$PassData->sending     = true;
			$PassData->add_info    = [
				"full_data" => $sendMoneyResponse
			];
			return $PassData;
		} catch (Exception $e) {
			throw new \Exception($e->faultstring);
		}
	}

	function cancel_payment(Request $request){
		return redirect(env('PERSONAL_LINK_CAB'));
	}
}