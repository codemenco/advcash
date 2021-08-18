<?php


namespace Codemenco\Advcash;


use Codemenco\Advcash\Exceptions\AdvcashException;
use Codemenco\Advcash\Mappers\authDTO;
use Codemenco\Advcash\Mappers\createBitcoinInvoice;
use Codemenco\Advcash\Mappers\createBitcoinInvoiceRequest;
use Codemenco\Advcash\Service\MerchantWebService;

class AdvcashApi
{
	const CURRENCIES = [
		'USD', // Доллар США
		'EUR', // Евро
		'RUR', // Российский рубль
		'GBP', // Фунт стерлингов
		'UAH', // Украинская гривна
		'KZT', // Казахстанский тенге
		'BRL', // Бразильский реал
	];

	private $auth;

	private $service;

	private $invoice;

	public function __construct()
	{
		$this->service = new MerchantWebService();

		$this->auth = new authDTO();
		$this->auth->apiName = config('advcash.api_name');
		$this->auth->accountEmail = config('advcash.api_email');
		$this->auth->authenticationToken = $this->service->getAuthenticationToken( config('advcash.api_password') );

	}

	public function makeBitcoinInvoice($amount,string $currency = 'EUR', string $order_id = '')
	{
		$invoice = new createBitcoinInvoiceRequest();
		$invoice->amount = $amount;
		$invoice->currency = $currency;
		if( $order_id !== '' ) $invoice->orderId = $order_id;

		$bitcoin_invoice = new createBitcoinInvoice();
		$bitcoin_invoice->arg0 = $this->auth;
		$bitcoin_invoice->arg1 = $invoice;

		try {
			return $this->service->createBitcoinInvoice($bitcoin_invoice);
		} catch (\Exception $e) {
			throw new AdvcashException($e->getMessage(),$e->getCode());
		}
	}
	
	public function sendMoney($amount,string $currency = 'EUR', string $email, string $note = '', $savePaymentTemplate = false)
	{
		$arg1 = new sendMoneyRequest();
		$arg1->amount = $amount;
		$arg1->currency = $currency;
		$arg1->email = $email;
		$arg1->note = $note;
		$arg1->savePaymentTemplate = $savePaymentTemplate;
	

		$validationSendMoney = new validationSendMoney();
		$validationSendMoney->arg0 = $this->auth;
		$validationSendMoney->arg1 = $arg1;
		
		$sendMoney = new sendMoney();
                $sendMoney->arg0 = $this->auth;
                $sendMoney->arg1 = $arg1;

		try {
			$this->service->validationSendMoney($validationSendMoney);
			$sendMoneyResponse = $merchantWebService->sendMoney($sendMoney);
			return $sendMoneyResponse;
		} catch (\Exception $e) {
			throw new AdvcashException($e->getMessage(),$e->getCode());
		}
	}
}
