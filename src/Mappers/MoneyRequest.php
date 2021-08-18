<?php


namespace Codemenco\Advcash\Mappers;


class MoneyRequest
{
	/**
	 * @access public
	 * @var double
	 */
	public $amount;
	/**
	 * @access public
	 * @var tnscurrency
	 */
	public $currency;
	/**
	 * @access public
	 * @var string
	 */
	public $note;
	/**
	 * @access public
	 * @var boolean
	 */
	public $savePaymentTemplate;
}
