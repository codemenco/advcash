<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Codemenco\AdvCash\AdvCash;
use Config;
class PulseBitcoinHandlerPayments extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBalance()
    {
    	$advcash = new AdvCash();
    	$balance = $advcash->balance('USD');
    	$this->assertLessThanOrEqual($balance, 0);
    }

    public function testForm(){
    	$advcash = new AdvCash();
    	$form = $advcash->form(1, 10, 'USD');
    	$this->assertSame(gettype($form), 'string');
    }

    public function testIPNRequestUnCorrect(){
    	$advcash = new AdvCash();
    	$data = [

    	];
    	$result = $advcash->check_transaction($data, [], []);
    	$this->assertSame($result->original['status'], 'faild');
    	$this->assertEquals(422, $result->status());
    }

    public function testIPNRequest(){
    	$advcash = new AdvCash();
    	$generate_hash = 
    	$data = [
			'ac_hash'      => 1,
			'ac_amount'    => 1,
			'operation_id' => 1,
			'ac_transfer'  => 1,
			'ac_merchant_currency'  => 1,
			'ac_order_id'  => 1,
			'ac_src_wallet' => 'U1234',
			'ac_start_date' => 'Now()',
			'ac_transfer' => 1
    	];

    	$arHash = array(
			$data["ac_transfer"],
			$data["ac_start_date"],
			Config::get('advcash.ac_sci_name'),
			$data["ac_src_wallet"],
			Config::get('advcash.ac_dest_wallet'),
			$data["ac_order_id"],
			$data["ac_amount"],
			$data["ac_merchant_currency"],
			Config::get('advcash.ac_sci_secret'),
		);
		$data['ac_hash'] = hash('sha256', implode(":", $arHash));

    	$result = $advcash->check_transaction($data, [], []);
    	$this->assertSame($result->original['status'], 'success');
    	$this->assertEquals(200, $result->status());
    }
}
