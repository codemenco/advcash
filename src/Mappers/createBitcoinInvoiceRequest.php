<?php


namespace Codemenco\Advcash\Mappers;


class createBitcoinInvoiceRequest extends MoneyRequest
{
	/**
	 * @access public
	 * @var string
	 */
	public $orderId;
	/**
	 * @access public
	 * @var string
	 */
	public $sciName;
	/**
	 * @access public
	 * @var string
	 */
	public $subMerchantURL;
}
