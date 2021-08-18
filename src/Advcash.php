<?php


namespace Codemenco\Advcash;


use Codemenco\Advcash\Exceptions\AdvcashException;
use Codemenco\Advcash\Mappers\AdvcashMapper;

class Advcash
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

	private $form;

	/**
	 * Advcash constructor.
	 * @param string $currency
	 */
	public function __construct(string $currency = 'EUR')
	{
		$this->form = new AdvcashMapper();

		$this->setCurrency($currency);

		if( !$email = config('advcash.sci_email') ) {
			throw new AdvcashException('Not set env ADVCASH_EMAIL',422);
		}
		$this->form->ac_account_email = $email;

		if( !$name = config('advcash.sci_name') ) {
			throw new AdvcashException('Not set env ADVCASH_NAME',422);
		}
		$this->form->ac_sci_name = $name;

		if( !$name = config('advcash.sci_password') ) {
			throw new AdvcashException('Not set env ADVCASH_PASS',422);
		}

		$this->form->setSecret(config('advcash.sci_password'));
	}

	/**
	 * @param float $amount
	 * @param string $order_id
	 * @return string
	 */
	public function createBitcoinRequest(float $amount, string $order_id, string $comment = '', string $ident = ''): string
	{
		$this->form->ac_amount = number_format($amount,2);
		$this->form->ac_order_id = $order_id;
		$this->form->comment = $comment;
		$this->form->ident = $ident;

		$this->form->makeSign();

		return $this->redner();
	}

	/**
	 * @return string
	 * @throws \Throwable
	 */
	protected function redner(): string
	{
		return view('advcash::form',get_object_vars($this->form))->render();
	}

	/**
	 * @param string $currency
	 */
	public function setCurrency(string $currency): self
	{
		if( !in_array($currency,static::CURRENCIES) ) {
			throw new AdvcashException('Wrong currency',220);
		}
		$this->form->ac_currency = $currency;
		return $this;
	}

	/**
	 * @param string $route_url
	 */
	public function setSuccessRoute(string $route_url): void
	{
		$this->form->ac_success_url = $route_url;
	}

	/**
	 * @param string $route_url
	 */
	public function setStatusRoute(string $route_url): void
	{
		$this->form->ac_status_url = $route_url;
	}

	/**
	 * @param string $route_url
	 */
	public function setFailRoute(string $route_url): void
	{
		$this->form->ac_fail_url = $route_url;
	}
}
