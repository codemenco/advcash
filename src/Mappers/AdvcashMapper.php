<?php


namespace Codemenco\Advcash\Mappers;

use Exception;

class AdvcashMapper
{
	private $secret;

	//public data
	public $action = 'https://wallet.advcash.com/sci/';
	public $ac_amount;
	public $ac_account_email;
	public $ac_sci_name;
	public $ac_currency;
	public $ac_order_id;
	public $ac_sign;
	public $ac_success_url;
	public $ac_fail_url;
	public $ac_status_url;
	public $comment;

	public $ident;

	public function __construct()
	{
		if( config('advcash.default',false) ) {
			$this->ac_success_url = route('advcash.confirm');
			$this->ac_fail_url    = route('advcash.cancel');
			$this->ac_status_url  = route('advcash.status');
		}
	}

	/**
	 * @param string $secret
	 */
	public function setSecret(string $secret): void
	{
		$this->secret = $secret;
	}

	/**
	 * Generate sign
	 */
	public function makeSign(): void
	{
		$this->ac_sign = hash(
			'sha256',
			implode(':', [
				$this->ac_account_email,
				$this->ac_sci_name,
				$this->ac_amount,
				$this->ac_currency,
				$this->secret,
				$this->ac_order_id
			])
		);
	}
}
