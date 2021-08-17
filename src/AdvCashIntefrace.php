<?php
namespace Codemenco\Advcash;

use Illuminate\Http\Request;

interface AdvCashInterface {
	/**
	 * Get balance
	 * @param  string $unit Currency to get balance
	 * @return float       real balance
	 */
	public function balance($unit);

	/**
	 * Create payment form
	 * @param  integer $payment_id uniq payment id
	 * @param  float $amount     amount to payment
	 * @param  string $units      Currency
	 * @return test             form to go site
	 */
	public function form($payment_id, $amount, $units);

	/**
	 * Valid
	 * @param  array  $request params from payment system
	 * @param  array  $server  server data
	 * @param  [type] $headers headers
	 * @return bool          true|false
	 */
	public function check_transaction(array $request, array $server, $headers);

	/**
	 * Send money to another account
	 * @param  integer $payment_id id transaction of identyfy
	 * @param  float $amount     [description]
	 * @param  to send $address    [description]
	 * @param  string $currency   [description]
	 * @return bool             
	 */
	public function send_money($payment_id, $amount, $address, $currency);

	/**
	 * [cancel_payment description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function cancel_payment(Request $request);
}