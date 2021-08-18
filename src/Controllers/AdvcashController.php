<?php


namespace Codemenco\Advcash\Controllers;

use Codemenco\Advcash\Events\AdvcashPaymentIncome;
use Codemenco\Advcash\Events\AdvcashPaymentStatus;
use Codemenco\Advcash\Events\AdvcashPaymentCancel;
use Codemenco\Advcash\Mappers\AdvcashConfirmResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Codemenco\Advcash\Exceptions\AdvcashException;
use Log;

class AdvcashController extends Controller
{
	public function cancel_payment(Request $request)
	{
		#TODO
		Log::error('cancel_payment',[
			$request->all()
		]);

		event(new AdvcashPaymentCancel($request->all()));
	}

	public function status(Request $request)
	{
		return $this->checkData($request,'status');
	}

	public function confirm(Request $request)
	{
		return $this->checkData($request,'confirm');
	}

	protected function checkData(Request $request,string $status)
	{
		$textResponse = [
			'status' => 'success'
		];

		$post   = $request->all();
		$server = $request->server();

		try {
			if( $is_complete = $this->validateIPN($post, $server) ) {
				$PassData = new AdvcashConfirmResponse();
				$PassData->amount             = $post['ac_amount'];
				$PassData->payment_id         = $post['operation_id'];
				$PassData->transaction        = $post['ac_transfer'];
				$PassData->add_info           = [
					"full_data_ipn" => json_encode($post)
				];

				if($status == 'confirm') event(new AdvcashPaymentIncome($PassData));

				if($status == 'status') event(new AdvcashPaymentStatus($PassData));

				return response()->json($textResponse,200);
			}
		} catch (AdvcashException $e) {
			Log::error('AdvCash IPN', [
				'message' => $e->getMessage()
			]);
			$textReponce['status']  = 'faild';
			$textReponce['message'] = $e->getMessage();
			return response()->json($textReponce, 422);
		}

		return response()->json($textResponse,200);
	}

	protected function validateIPN(array $post_data, array $server_data)
	{
		if(!isset($post_data['ac_hash'])){
			throw new AdvcashException("For validate IPN need ac_hash");
		}

		$arHash = [
			$post_data["ac_transfer"],
			$post_data["ac_start_date"],
			config('advcash.api_name'),
			$post_data["ac_src_wallet"],
			$post_data['ac_dest_wallet'],
			$post_data["ac_order_id"],
			$post_data["ac_amount"],
			$post_data["ac_merchant_currency"],
			config('advcash.api_password'),
		];

		$sign = hash('sha256', implode(":", $arHash));

		if( !hash_equals($post_data['ac_hash'],$sign) ) {
			throw new AdvcashException("Hash no valid");
		}

		return true;
	}


}
