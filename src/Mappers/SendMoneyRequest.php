<?php


namespace Codemenco\Advcash\Mappers;


class SendMoneyRequest extends MoneyRequest
{
	/**
	 * @access public
	 * @var string
	 */
	public $email;
	/**
	 * @access public
	 * @var string
	 */
	public $walletId;
}
